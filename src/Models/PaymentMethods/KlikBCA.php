<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class KlikBCA extends PaymentMethod implements HasApi, HasSnap
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

    public function getSnapName(): string
    {
        return 'bca_klikbca';
    }

    public function getApiPaymentType(): string
    {
        return 'bca_klikbca';
    }

    public function getApiPaymentPayload(): array
    {
        return [
            'user_id' => $this->getUserId(),
            'description' => $this->getDescription(),
        ];
    }
}
