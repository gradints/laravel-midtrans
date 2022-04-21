<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Kredivo extends PaymentMethod implements HasApi
{
    public function getApiPaymentType(): string
    {
        return 'kredivo';
    }

    public function getApiPaymentPayload(): array
    {
        return [];
    }
}