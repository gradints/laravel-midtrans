<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Qris extends PaymentMethod
{
    /**
     * Possible values are airpay, shopee, gopay.
     */
    public function __construct(private string $acquirer = '')
    {
    }

    public function setAcquirer(string $acquirer): void
    {
        $this->acquirer = $acquirer;
    }

    public function getPaymentType(): string
    {
        return 'qris';
    }

    public function getPaymentPayload(): array
    {
        return [
            'acquirer' => $this->acquirer,
        ];
    }
}
