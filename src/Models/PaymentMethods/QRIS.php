<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class QRIS extends PaymentMethod
{
    public function __construct(private string $acquirer = 'gopay')
    {
    }

    public function setAcquirer(string $acquirer): void
    {
        $this->acquirer = $acquirer;
    }

    public function getAcquirer(): string
    {
        return $this->acquirer;
    }

    public function getPaymentType(): string
    {
        return 'qris';
    }

    public function getPaymentPayload(): array
    {
        return [
            'acquirer' => $this->getAcquirer(),
        ];
    }
}
