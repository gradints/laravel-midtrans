<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Indomaret extends PaymentMethod
{
    private string $message = '';

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getPaymentType(): string
    {
        return 'cstore';
    }

    public function getPaymentPayload(): array
    {
        // https://api-docs.midtrans.com/#indomaret
        return array_filter([
            'store' => 'Indomaret',
            'message' => $this->getMessage(),
        ]);
    }
}
