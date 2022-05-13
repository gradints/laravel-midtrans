<?php

namespace Gradints\LaravelMidtrans;

use Gradints\LaravelMidtrans\Enums\TransactionStatus;
use Gradints\LaravelMidtrans\Models\Customer;
use Gradints\LaravelMidtrans\Models\PaymentMethod;
use Gradints\LaravelMidtrans\Models\Refund;
use Gradints\LaravelMidtrans\Models\Transaction;
use Midtrans\Config as MidtransConfig;
use Midtrans\CoreApi as MidtransCoreApi;
use Midtrans\Snap as MidtransSnap;
use Midtrans\Transaction as MidtransTransaction;

class Midtrans
{
    private Customer $customer;

    private Transaction $transaction;

    private Refund $refund;

    public function __construct()
    {
        // https://docs.midtrans.com/en/snap/integration-guide?id=sample-request
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = app()->environment('production');
        MidtransConfig::$isSanitized = config('midtrans.use_sanitizer', false);
        MidtransConfig::$is3ds = config('midtrans.enable_3ds', false);
    }

    public function setCustomer(string $name, string $email, string $phone = '')
    {
        $this->customer = new Customer($name, $email, $phone);
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer ?? null;
    }

    public function setTransaction(string $orderId, int $grossAmount, iterable $items = [])
    {
        $this->transaction = new Transaction($orderId, $grossAmount, $items);
    }

    public function getTransaction(): ?Transaction
    {
        return $this->transaction ?? null;
    }

    public function setRefund(string $refundKey = null, int $amount = null, string $reason = null)
    {
        $this->refund = new Refund($refundKey, $amount, $reason);
    }

    public function getRefund(): ?Refund
    {
        return $this->refund ?? null;
    }

    public function getCallbackUrl(): string
    {
        return config('midtrans.redirect.finish');
    }

    public function getSnapPaymentMethods(): array
    {
        return config('midtrans.enabled_payments');
    }

    public function generateRequestPayloadForSnap(): array
    {
        return [
            // set transaction_details, https://api-docs.midtrans.com/?php#transaction-details-object
            'transaction_details' => [
                'order_id' => $this->transaction->getOrderId(),
                'gross_amount' => $this->transaction->getGrossAmount(),
            ],
            // set item_details, https://api-docs.midtrans.com/?php#item-details-object
            'item_details' => $this->transaction->getItems(),
            // set customer_details, https://api-docs.midtrans.com/?php#customer-details-object
            'customer_details' => array_filter([
                'firstName' => $this->customer->getFirstName(),
                'lastName' => $this->customer->getLastName(),
                'email' => $this->customer->getEmail(),
                'billing_address' => $this->customer->getBillingAddress(),
                'shipping_address' => $this->customer->getShippingAddress(),
            ]),
            // set expiry
            'expiry' => [
                'duration' => config('midtrans.expiry.duration'),
                'init' => config('midtrans.expiry.duration_unit'),
            ],
            // set enabled_payments
            'enabled_payments' => $this->getSnapPaymentMethods(),
            // set callbacks
            'callbacks' => [
                'finish' => $this->getCallbackUrl(),
            ],
        ];
    }

    public function generateRequestPayloadForApi(PaymentMethod $paymentMethod): array
    {
        return [
            // set transaction_details, https://api-docs.midtrans.com/?php#transaction-details-object
            'transaction_details' => [
                'order_id' => $this->transaction->getOrderId(),
                'gross_amount' => $this->transaction->getGrossAmount(),
            ],
            // set item_details, https://api-docs.midtrans.com/?php#item-details-object
            'item_details' => $this->transaction->getItems(),
            // set customer_details, https://api-docs.midtrans.com/?php#customer-details-object
            'customer_details' => array_filter([
                'firstName' => $this->customer->getFirstName(),
                'lastName' => $this->customer->getLastName(),
                'email' => $this->customer->getEmail(),
                'billing_address' => $this->customer->getBillingAddress(),
                'shipping_address' => $this->customer->getShippingAddress(),
            ]),
            // set expiry, https://api-docs.midtrans.com/?php#custom-expiry-object
            'custom_expiry' => [
                'expiry_duration' => config('midtrans.expiry.duration'),
                'unit' => config('midtrans.expiry.duration_unit'),
            ],
            'payment_type' => $paymentMethod->getPaymentType(),
            $paymentMethod->getPaymentType() => $paymentMethod->getPaymentPayload(),
        ];
    }

    public function generateRequestPayloadForRefund(): array
    {
        return [
            'refund_key' => $this->refund->getRefundKey(),
            'amount' => $this->refund->getAmount(),
            'reason' => $this->refund->getReason(),
        ];
    }

    public function createSnapTransaction(): object
    {
        $payload = $this->generateRequestPayloadForSnap();

        return MidtransSnap::createTransaction($payload);
    }

    public function createApiTransaction(PaymentMethod $paymentMethod): object
    {
        $payload = $this->generateRequestPayloadForApi($paymentMethod);

        return MidtransCoreApi::charge($payload);
    }

    public function refundTransaction(string $id): object
    {
        $payload = $this->generateRequestPayloadForRefund();

        // https://api-docs.midtrans.com/#refund-transaction
        // only support credit card
        return MidtransTransaction::refund($id, $payload);
    }

    public function refundDirectTransaction(string $id): object
    {
        $payload = $this->generateRequestPayloadForRefund();

        // https://api-docs.midtrans.com/#direct-refund-transaction
        // only support Gopay, QRIS, ShopeePay, And Credit Card
        return MidtransTransaction::refundDirect($id, $payload);
    }

    public static function getTransactionStatus(string $orderId): void
    {
        // TODO check fraud status

        // in https://api-docs.midtrans.com/?php#transaction-status

        $response = \Midtrans\Transaction::status($orderId);

        // if ($response['status_code'] !== 200) {
        //     return;
        // }

        // TODO throw InvalidRequestException

        self::executeActionByStatus($response['transaction_status'], $response);
    }

    public static function executeActionByStatus(string $status, $payload): void
    {
        $function = TransactionStatus::from($status)->getAction();

        if ($function) {
            MidtransHelpers::callFunction($function, $payload);
        }
    }
}
