<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class CreditCard extends PaymentMethod implements HasSnap, HasApi
{
    private string $bank = '';
    private int $installmentTerm = 0;
    private array $bins = [];
    private string $type = '';
    private bool $saveTokenId = false;

    public function __construct(private string $tokenId = '')
    {
    }

    public function setTokenId(string $tokenId): void
    {
        $this->tokenId = $tokenId;
    }

    public function getTokenId(): string
    {
        return $this->tokenId;
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

    public function setSaveTokenId(bool $saveTokenId): void
    {
        $this->saveTokenId = $saveTokenId;
    }

    public function getSaveTokenId(): bool
    {
        return $this->saveTokenId;
    }

    public function getSnapName(): string
    {
        return 'credit_card';
    }

    public function getApiPaymentType(): string
    {
        return 'credit_card';
    }

    public function getApiPaymentPayload(): array
    {
        return array_filter([
            'token_id' => $this->tokenId,
            'bank' => $this->bank,
            'installment_term' => $this->installmentTerm,
            'bins' => $this->bins,
            'type' => $this->type,
            'save_token_id' => $this->saveTokenId,
            // TODO low priority 'bank' Valid values are: mandiri, bni, cimb, bca, maybank, and bri.
            // TODO low priority 'bins' List of credit card's BIN (Bank Identification Number) that is allowed for transaction.
            // TODO low priority 'type' Used as preauthorization feature. Valid value: authorize.
        ]);
    }

    // snap
    // [
    //     'transaction_details' => [
    //         'order_id' => 'inv_19042022_01',
    //         'gross_amount' => 20_000,
    //     ],
    //     'expiry' => [
    //         'duration' => 1,
    //         'init' => 'day' // second, minute, hour, day],
    //     ]
    //     'customer_details' => [
    //         'firstName' => 'John',
    //         'lastName' => 'Doe',
    //         'email' => 'johnDoe@example.com'
    //     ],
    //     'enabled_payments' => ['credit_card'],
    //     'callbacks' => [
    //       'finish' => 'https://demo.midtrans.com'
    //     ]
    // ];

    // Api nya??
    // "credit_card": {
    //     "token_id": "4811117d16c884-2cc7-4624-b0a8-10273b7f6cc8",
    //     "bank": "bni",
    //     "installment_term": 6,
    //     "bins": ["4811", "5233"],
    //     "type": "authorize",
    //     "save_token_id": true
    // }
}
