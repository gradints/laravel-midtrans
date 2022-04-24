<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Configuration midtrans
     |--------------------------------------------------------------------------
     |
     | TODO description
     |
     */

    'server_key' => env('midtrans_server_key'),
    'enable_3ds' => true,

    /*
     |--------------------------------------------------------------------------
     | Expiry configuration
     |--------------------------------------------------------------------------
     |
     | TODO description
     | Set how long the transaction kept alive until it is expired.
     | Possible values for duration_unit: second, minute, hour, day.
     |
     */
    'expiry' => [
        'duration' => 1,
        'duration_unit' => 'day',
    ],

    /*
     |--------------------------------------------------------------------------
     | Endpoint Settings
     |--------------------------------------------------------------------------
     |
     | TODO Description
     | Set finish_redirect to your frontend payment success page.
     |
     */
    'redirect' => [
        // Customer sent here if payment is successful
        'finish' => '',
        // Customer sent here if they click on 'Back to Order Website' on VT-Web’s payment page
        // 'unfinish' => '',
        //
        // 'error' => '',
    ],

    /*
     |--------------------------------------------------------------------------
     | Notification Settings
     |--------------------------------------------------------------------------
     |
     | TODO description
     | Example payment_notification: 'App\Models\Payment::setPaymentAsDone'
     |
     | When Midtrans send https post request to '/midtrans/payment-notification',
     | MidtransController will execute App\Models\Payment::setPaymentAsDone($response)
     |
     | Function to run when Midtrans send HTTP Post request to payment notification route
     */
    'payment_notification' => [
        'pending' => ['App\Models\Purchase', 'onPending'],
        'capture' => ['App\Models\Purchase', 'onCapture'],
        'settlement' => ['App\Models\Purchase', 'onSettlement'],
        'cancel' => ['App\Models\Purchase', 'onCancel'],
        'deny' => ['App\Models\Purchase', 'onDeny'],
        'expire' => ['App\Models\Purchase', 'onExpire'],
        'failure' => ['App\Models\Purchase', 'onFailure'],
        'authorize' => ['App\Models\Purchase', 'onAuthorize'],
        'refund' => ['App\Models\Purchase', 'onRefund'],
        'partial_refund' => ['App\Models\Purchase', 'onPartialRefund'],
        'chargeback' => ['App\Models\Purchase', 'onChargeback'],
        'partial_chargeback' => ['App\Models\Purchase', 'onPartialChargeback'],
    ],
    // Function to run when Midtrans send HTTP Post request to recurring notification route
    // 'recurring_notification' => ['App\Models\User', 'updateMembershipStatus'],
    // Function to run when Midtrans send HTTP Post request to pay account notification route
    // 'pay_account_notification' => '',

    /*
     |--------------------------------------------------------------------------
     | Specify payment methods available for SNAP
     |--------------------------------------------------------------------------
     |
     | TODO description
     |
     */
    'enabled_payments' => [
        'credit_card',

        // Bank Transfer
        'bca_va',
        'bni_va',
        'bri_va',
        'permata_va',
        'echannel', // Mandiri bill

        // Internet Banking
        'bca_klikbca',
        'bca_klikpay',
        'bri_epay', // brimo
        'cimb_clicks',
        'danamon_online',

        // E-Money
        'gopay',
        'shopeepay',

        // Cardless credit
        'akulaku',

        // Over the Counter
        'alfamart',
        'indomaret',
    ],
];
