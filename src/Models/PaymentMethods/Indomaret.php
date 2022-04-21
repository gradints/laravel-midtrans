<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Indomaret extends PaymentMethod implements HasSnap, HasApi
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

    public function getSnapName(): string
    {
        return 'indomaret';
    }

    public function getApiPaymentType(): string
    {
        return 'indomaret';
    }

    public function getApiPaymentPayload(): array
    {
        return array_filter([
            'store' => $this->getApiPaymentType(),
            'message' => $this->getMessage(),
        ]);
    }
}
