<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Gopay extends PaymentMethod
{
    private bool $enableCallback = false;

    public function enableCallback(): void
    {
        $this->enableCallback = true;
    }

    public function dontEnableCallback(): void
    {
        $this->enableCallback = false;
    }

    public function getEnableCallback(): bool
    {
        return $this->enableCallback;
    }

    public function getPaymentType(): string
    {
        return 'gopay';
    }

    public function getPaymentPayload(): array
    {
        return ['enable_callback' => $this->getEnableCallback()];
    }
}
