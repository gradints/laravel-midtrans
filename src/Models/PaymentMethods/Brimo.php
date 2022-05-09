<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Brimo extends PaymentMethod
{
    public function getPaymentType(): string
    {
        return 'bri_epay';
    }

    public function getPaymentPayload(): array
    {
        return [];
    }
}
