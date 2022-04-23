<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class DanamonOnlineBanking extends PaymentMethod
{
    public function getPaymentType(): string
    {
        return 'danamon_online';
    }

    public function getPaymentPayload(): array
    {
        return [];
    }
}
