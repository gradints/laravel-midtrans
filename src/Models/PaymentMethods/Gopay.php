<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class Gopay extends PaymentMethod implements HasSnap, HasApi
{
    private bool $enableCallback = false;

    public function setEnableCallback(bool $enableCallback): void
    {
        $this->enableCallback = $enableCallback;
    }

    public function getEnableCallback(): bool
    {
        return $this->enableCallback;
    }

    public function getSnapName(): string
    {
        return 'gopay';
    }

    public function getApiPaymentType(): string
    {
        return 'gopay';
    }

    public function getApiPaymentPayload(): array
    {
        return ['enable_callback' => $this->getEnableCallback()];
    }

    // api
    // [
    //     'transaction_details' => [
    //         'order_id' => 'inv_19042022_01',
    //         'gross_amount' => 20_000,
    //     ],
    //     'custom_expiry' => [
    //         'duration' => 1,
    //         'init' => 'day' // second, minute, hour, day],
    //     ]
    //     'customer_details' => [
    //         'firstName' => 'John',
    //         'lastName' => 'Doe',
    //         'email' => 'johnDoe@example.com'
    //     ],
    //     'payment_type' => 'gopay',
    //     'gopay' => [
    //       "enable_callback": true,
    //       "callback_url": "someapps://callback"
    //     ],
    // ];

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
    //     'enabled_payments' => ['gopay'],
    //     'callbacks' => [
    //         'finish' => 'https://demo.midtrans.com'
    //     ]
    // ];
}
