<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class PermataBank extends PaymentMethod implements HasSnap, HasApi
{
    public function getSnapName(): string
    {
        return 'permata_va';
    }

    public function getApiPaymentType(): string
    {
        return 'bank_transfer';
    }

    public function getApiPaymentPayload(): array
    {
        return [
            'bank' => 'permata',
        ];
    }

    // api
    //  [
    //     'transaction_details' => [
    // 		'order_id' => 'inv_19042022_01',
    // 		'gross_amount' => 20_000,
    // 	],
    //     'custom_expiry' => [
    // 		'duration' => 1,
    // 		'init' => 'day' // second, minute, hour, day],
    // 	]
    //     'customer_details' => [
    // 		'firstName' => 'John',
    // 		'lastName' => 'Doe',
    // 		'email' => 'johnDoe@example.com'
    // 	],
    // 	'payment_type' => 'bank_transfer',
    // 	'bank_transfer' => [
    // 		'bank' => 'permata'
    // 	],
    // ];

    // snap
// 	[
//         'transaction_details' => [
// 			'order_id' => 'inv_19042022_01',
// 			'gross_amount' => 20_000,
// 		],
//         'expiry' => [
// 			'duration' => 1,
// 			'init' => 'day' // second, minute, hour, day],
// 		]
//         'customer_details' => [
// 			'firstName' => 'John',
// 			'lastName' => 'Doe',
// 			'email' => 'johnDoe@example.com'
// 		],
// 		'enabled_payments' => ['permata_va'],
// 		'callbacks' => [
// 			'finish' => 'https://demo.midtrans.com'
// 	    ]
//   ];
}
