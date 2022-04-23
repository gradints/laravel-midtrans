<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class KlikBCA extends PaymentMethod
{
    private string $userId;
    private string $description;

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

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
        return 'bca_klikbca';
    }

    public function getPaymentPayload(): array
    {
        // https://api-docs.midtrans.com/#klikbca
        return [
            'user_id' => $this->getUserId(),
            'description' => $this->getDescription(),
        ];
    }
}
