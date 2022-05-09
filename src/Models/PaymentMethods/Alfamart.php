<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Alfamart extends PaymentMethod
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

    public function getPaymentType(): string
    {
        return 'cstore';
    }

    public function getPaymentPayload(): array
    {
        return array_filter([
            'store' => 'alfamart',
            'alfamart_free_text_1' => $this->alfamartFreeText1,
            'alfamart_free_text_2' => $this->alfamartFreeText2,
            'alfamart_free_text_3' => $this->alfamartFreeText3,
        ]);
    }
}
