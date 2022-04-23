<?php

namespace Gradints\LaravelMidtrans;

use Gradints\LaravelMidtrans\Models\Customer;
use Gradints\LaravelMidtrans\Models\PaymentMethod;
use Gradints\LaravelMidtrans\Models\Transaction;
use Illuminate\Support\Facades\Config;
use Midtrans\Config as MidtransConfig;
use Midtrans\CoreApi as MidtransCoreApi;
use Midtrans\Snap as MidtransSnap;

class Midtrans
{
    private Customer $customer;

    private Transaction $transaction;

    public function __construct()
    {
        // https://docs.midtrans.com/en/snap/integration-guide?id=sample-request
        // Set your Merchant Server Key
        MidtransConfig::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = app()->environment('production');
        // Set sanitization on (default)
        // MidtransConfig::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = config('midtrans.enable_3ds');
    }

    public function setCustomer(string $name, string $email, string $phone = '')
    {
        $this->customer = new Customer($name, $email, $phone);
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer ?? null;
    }

    public function setTransaction(string $orderId, int $grossAmount, array $items = [])
    {
        $this->transaction = new Transaction($orderId, $grossAmount, $items);
    }

    public function getTransaction(): ?Transaction
    {
        return $this->transaction ?? null;
    }

    public function getCallbackUrl(): string
    {
        return Config::get('midtrans.redirect.finish');
    }

    public function getSnapPaymentMethods(): array
    {
        return Config::get('midtrans.payment_methods.snap');
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
            'customer_details' => [
                'firstName' => $this->customer->getFirstName(),
                'lastName' => $this->customer->getLastName(),
                'email' => $this->customer->getEmail(),
            ],
            // set expiry
            'expiry' => [
                'duration' => Config::get('midtrans.expiry.duration'),
                'init' => Config::get('midtrans.expiry.duration_unit'),
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
            'customer_details' => [
                'firstName' => $this->customer->getFirstName(),
                'lastName' => $this->customer->getLastName(),
                'email' => $this->customer->getEmail(),
            ],
            // set expiry, https://api-docs.midtrans.com/?php#custom-expiry-object
            'custom_expiry' => [
                'duration' => Config::get('midtrans.expiry.duration'),
                'init' => Config::get('midtrans.expiry.duration_unit'),
            ],
            'payment_type' => $paymentMethod->getPaymentType(),
            $paymentMethod->getPaymentType() => $paymentMethod->getPaymentPayload(),
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
}
