<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class CIMBClicks extends PaymentMethod
{
    private string $description;

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPaymentType(): string
    {
        return 'cimb_clicks';
    }

    public function getPaymentPayload(): array
    {
        // https://api-docs.midtrans.com/#cimb-clicks
        return [
            'description' => $this->getDescription(),
        ];
    }
}
