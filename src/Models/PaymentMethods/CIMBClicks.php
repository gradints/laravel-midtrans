<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class CIMBClicks extends PaymentMethod implements  HasApi, HasSnap 
{
    private string $description;

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
        return 'cimb_clicks';
    }

    public function getApiPaymentType(): string
    {
        return 'cimb_clicks';
    }

    public function getApiPaymentPayload(): array
    {
        return ['description' => $this->getDescription()];
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
    //     'payment_type' => 'cimb_clicks',
    //     'cimb_clicks' => [
    //       "description": "mss shop bill" // required 
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
    //     'enabled_payments' => ['cimb_clicks'],
    //     'callbacks' => [
    //       'finish' => 'https://demo.midtrans.com'
    //     ]
    // ];
}