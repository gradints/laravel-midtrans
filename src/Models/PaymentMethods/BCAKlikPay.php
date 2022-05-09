<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class BCAKlikPay extends PaymentMethod
{
    private string $description = '';

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPaymentType(): string
    {
        return 'bca_klikpay';
    }

    public function getPaymentPayload(): array
    {
        // https://api-docs.midtrans.com/#bca-klikpay
        return [
            'description' => $this->getDescription(),
        ];
    }
}
