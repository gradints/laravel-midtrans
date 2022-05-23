<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethod;

class CreditCard extends PaymentMethod
{
    private string $bank = '';
    private bool $authentication = false;
    private int $installmentTerm = 0;
    private array $bins = [];
    private string $type = '';
    private bool $saveTokenId = true; // enable

    public function __construct(private string $tokenId = '')
    {
        if (config('midtrans.enable_3ds')) {
            $this->enable3ds();
        }
    }

    public function setTokenId(string $tokenId): void
    {
        $this->tokenId = $tokenId;
    }

    public function getTokenId(): string
    {
        return $this->tokenId;
    }

    public function enable3ds(): void
    {
        $this->authentication = true;
    }

    public function disable3ds(): void
    {
        $this->authentication = false;
    }

    public function setBank(string $bank): void
    {
        $this->bank = $bank;
    }

    public function getBank(): string
    {
        return $this->bank;
    }

    public function setInstallmentTerm(int $installmentTerm): void
    {
        $this->installmentTerm = $installmentTerm;
    }

    public function getInstallmentTerm(): int
    {
        return $this->installmentTerm;
    }

    public function setBins(int ...$bins): void
    {
        $this->bins = $bins;
    }

    public function getBins(): array
    {
        return $this->bins;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function saveTokenId(): void
    {
        $this->saveTokenId = true;
    }

    public function dontSaveTokenId(): void
    {
        $this->saveTokenId = false;
    }

    public function getSaveTokenId(): bool
    {
        return $this->saveTokenId;
    }

    public function getPaymentType(): string
    {
        return 'credit_card';
    }

    public function getPaymentPayload(): array
    {
        // https://api-docs.midtrans.com/#card-payment
        return array_filter([
            'token_id' => $this->tokenId,
            'bank' => $this->bank,
            'installment_term' => $this->installmentTerm,
            'bins' => $this->bins,
            'type' => $this->type,
            'save_token_id' => $this->saveTokenId,
            'authentication' => $this->authentication,
            // TODO low priority 'bank' Valid values are: mandiri, bni, cimb, bca, maybank, and bri.
            // TODO low priority 'bins' List of credit card's BIN (Bank Identification Number) that is allowed for transaction.
            // TODO low priority 'type' Used as preauthorization feature. Valid value: authorize.
        ]);
    }
}
