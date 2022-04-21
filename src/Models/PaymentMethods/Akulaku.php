<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Akulaku extends PaymentMethod implements HasSnap, HasApi
{
    public function getSnapName(): string
    {
        return 'akulaku';
    }

    public function getApiPaymentType(): string
    {
        return 'akulaku';
    }

    public function getApiPaymentPayload(): array
    {
        return [];
    }
}