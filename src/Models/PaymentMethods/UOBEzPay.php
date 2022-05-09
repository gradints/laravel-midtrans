<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class UOBEzPay extends PaymentMethod
{
    public function getPaymentType(): string
    {
        return 'uob_ezpay';
    }

    public function getPaymentPayload(): array
    {
        return [];
    }
}
