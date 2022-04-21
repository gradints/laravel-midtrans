<?php

namespace Gradints\LaravelMidtrans\Models\PaymentMethods;

use Gradints\LaravelMidtrans\Interface\HasApi;
use Gradints\LaravelMidtrans\Interface\HasSnap;
use Gradints\LaravelMidtrans\Models\PaymentMethod;

class MandiriBank extends PaymentMethod implements HasSnap, HasApi
{
    private string $billInfo1 = 'Payment:';
    private string $billInfo2 = 'Online purchase';
    private string $billInfo3 = '';
    private string $billInfo4 = '';
    private string $billInfo5 = '';
    private string $billInfo6 = '';
    private string $billInfo7 = '';
    private string $billInfo8 = '';

    public function getSnapName(): string
    {
        return 'echannel';
    }

    public function getApiPaymentType(): string
    {
        return 'echannel';
    }

    /**
     * https://api-docs.midtrans.com/?php#e-channel-object
     */
    public function getApiPaymentPayload(): array
    {
        $infos = [
            // Label 1. Mandiri allows only 10 characters. Exceeding characters will be truncated.
            'bill_info1' => $this->billInfo1, // required
            // Value for Label 1. Mandiri allows only 30 characters. Exceeding characters will be truncated.
            'bill_info2' => $this->billInfo2, // required
            // Label 1. Mandiri allows only 10 characters. Exceeding characters will be truncated.
            'bill_info3' => $this->billInfo3, // optional
            // Value for Label 1. Mandiri allows only 30 characters. Exceeding characters will be truncated.
            'bill_info4' => $this->billInfo4, // optional
            // Label 1. Mandiri allows only 10 characters. Exceeding characters will be truncated.
            'bill_info5' => $this->billInfo5, // optional
            // Value for Label 1. Mandiri allows only 30 characters. Exceeding characters will be truncated.
            'bill_info6' => $this->billInfo6, // optional
            // Label 1. Mandiri allows only 10 characters. Exceeding characters will be truncated.
            'bill_info7' => $this->billInfo7, // optional
            // Value for Label 1. Mandiri allows only 30 characters. Exceeding characters will be truncated.
            'bill_info8' => $this->billInfo8, // optional
        ];

        return array_filter($infos);
    }

    public function setBillInfo(string ...$info)
    {
        $this->billInfo1 = $info[0];
        $this->billInfo2 = $info[1];
        $this->billInfo3 = $info[2] ?? '';
        $this->billInfo4 = $info[3] ?? '';
        $this->billInfo5 = $info[4] ?? '';
        $this->billInfo6 = $info[5] ?? '';
        $this->billInfo7 = $info[6] ?? '';
        $this->billInfo8 = $info[7] ?? '';
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
    //     'payment_type' => 'echannel',
    //     'echannel' => [
    //         'bill_info1' => 'payment for', // required
    //         'bill_info2' => 'mss bill', // required
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
    //     'enabled_payments' => ['echannel'],
    //     'callbacks' => [
    //         'finish' => 'https://demo.midtrans.com'
    //     ]
    // ];
}
