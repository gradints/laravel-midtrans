<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class ShopeePay extends PaymentMethod
{
    public function getPaymentType(): string
    {
        return 'shopeepay';
    }

    public function getPaymentPayload(): array
    {
        return [
            'callback_url' => config('midtrans.redirect.finish'),
        ];
    }
}
