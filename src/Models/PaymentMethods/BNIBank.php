<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class BNIBank extends PaymentMethod
{
    public function getPaymentType(): string
    {
        return 'bank_transfer';
    }

    public function getPaymentPayload(): array
    {
        return [
            'bank' => 'bni',
        ];
    }
}
