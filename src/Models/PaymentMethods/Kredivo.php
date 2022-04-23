<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Kredivo extends PaymentMethod
{
    public function getPaymentType(): string
    {
        return 'kredivo';
    }

    public function getPaymentPayload(): array
    {
        return [];
    }
}
