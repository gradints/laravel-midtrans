<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Alfamart extends PaymentMethod implements HasSnap, HasApi
{
    private string $alfamartFreeText1 = '';
    private string $alfamartFreeText2 = '';
    private string $alfamartFreeText3 = '';

    public function setAlfamartFreeText(string ...$texts): void
    {
        $this->alfamartFreeText1 = $texts[0];
        $this->alfamartFreeText2 = $texts[1] ?? '';
        $this->alfamartFreeText3 = $texts[2] ?? '';
    }

    public function getAlfamartFreeText(): array
    {
        return [];
    }

    public function getSnapName(): string
    {
        return 'alfamart';
    }
    
    public function getApiPaymentType(): string
    {
        return 'alfamart';
    }

    public function getApiPaymentPayload(): array
    {
        return array_filter([
            'store' => $this->getApiPaymentType(),
            'alfamart_free_text_1' => $this->alfamartFreeText1,
            'alfamart_free_text_2' => $this->alfamartFreeText2,
            'alfamart_free_text_3' => $this->alfamartFreeText3,
        ]);
    }
}