<?php

namespace Gradints\LaravelMidtrans\Models;

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
}
