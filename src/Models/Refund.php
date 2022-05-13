<?php

namespace Gradints\LaravelMidtrans\Models;

class Refund
{
    public function __construct(
        private ?string $refundKey = null,
        private ?int $amount = null,
        private ?string $reason = null
    ) {
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
}
