<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Akulaku extends PaymentMethod
{
    public function getPaymentType(): string
    {
        return 'akulaku';
    }

    public function getPaymentPayload(): array
    {
        return [];
    }
}
