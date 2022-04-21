<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class DanamonOnlineBanking extends PaymentMethod implements HasApi, HasSnap
{
    public function getSnapName(): string
    {
        return 'danamon_online';
    }

    public function getApiPaymentType(): string
    {
        return 'danamon_online';
    }

    public function getApiPaymentPayload(): array
    {
        return [];
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
    //     'payment_type' => 'danamon_online',
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
    //     'enabled_payments' => ['danamon_online'],
    //     'callbacks' => [
    //       'finish' => 'https://demo.midtrans.com'
    //     ]
    // ];
}
