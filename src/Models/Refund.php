<?php

namespace Gradints\LaravelMidtrans\Models;

use Gradints\LaravelMidtrans\Models\PaymentMethods\CreditCard;
use Gradints\LaravelMidtrans\Models\PaymentMethods\Gopay;
use Gradints\LaravelMidtrans\Models\PaymentMethods\Qris;
use Gradints\LaravelMidtrans\Models\PaymentMethods\ShopeePay;

class Refund
{
    public function __construct(
        private ?PaymentMethod $paymentMethod = null,
        private ?string $refundKey = null,
        private ?int $amount = null,
        private ?string $reason = null,
        private ?string $bank = null,
    ) {
    }

    public function setPaymentMethod(PaymentMethod $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    public function setRefundKey(string $refundKey): void
    {
        $this->refundKey = $refundKey;
    }

    public function getRefundKey(): ?string
    {
        return $this->refundKey;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setReason(string $reason): void
    {
        $this->reason = $reason;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setBank(string $bank): void
    {
        $this->bank = $bank;
    }

    public function getBank(): string
    {
        return $this->bank;
    }

    public function generatePayload()
    {
        return [
            'refund_key' => $this->getRefundKey(),
            'amount' => $this->getAmount(),
            'reason' => $this->getReason(),
        ];
    }

    // https://api-docs.midtrans.com/#refund-transaction
    public function isSupportRefund(): bool
    {
        if (!($this->paymentMethod instanceof CreditCard)) {
            return false;
        }

        if (!in_array($this->bank, ['bni', 'mandiri', 'cimb'])) {
            return false;
        }

        return true;
    }

    // https://api-docs.midtrans.com/#direct-refund-transaction
    public function isSupportRefundDirect(): bool
    {
        if ($this->paymentMethod instanceof CreditCard) {
            if (in_array($this->bank, ['bca', 'maybank', 'bri'])) {
                return true;
            }
        }

        if ($this->paymentMethod instanceof Gopay) {
            return true;
        }

        if ($this->paymentMethod instanceof ShopeePay) {
            return true;
        }

        if ($this->paymentMethod instanceof Qris) {
            return true;
        }

        return false;
    }
}
