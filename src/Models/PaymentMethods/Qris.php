<?php 

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Qris extends PaymentMethod implements HasApi
{
    public function __construct(private string $acquirer = 'gopay')
    {
    }

    public function setAcquirer(string $acquirer): void
    {
        $this->acquirer = $acquirer;
    }

    public function getApiPaymentType(): string
    {
        return 'qris';
    }
    
    public function getApiPaymentPayload(): array
    {
        return [
            'acquirer' => $this->acquirer,
        ];
    }
}