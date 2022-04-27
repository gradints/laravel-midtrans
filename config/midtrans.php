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

    // Get from https://dashboard.midtrans.com/settings/config_info
    'server_key' => env('midtrans_server_key'),
    'merchant_id' => env('midtrans_merchant_id'),

    // It truncate fields that have length limit, remove not allowed characters from other fields
    'use_sanitizer' => env('midtrans_use_sanitizer'),

    //
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
        'pending' => ['App\Services\PaymentGateway\NotificationAction', 'onPending'],
        'capture' => ['App\Services\PaymentGateway\NotificationAction', 'onCapture'],
        'settlement' => ['App\Services\PaymentGateway\NotificationAction', 'onSettlement'],
        'cancel' => ['App\Services\PaymentGateway\NotificationAction', 'onCancel'],
        'deny' => ['App\Services\PaymentGateway\NotificationAction', 'onDeny'],
        'expire' => ['App\Services\PaymentGateway\NotificationAction', 'onExpire'],
        'failure' => ['App\Services\PaymentGateway\NotificationAction', 'onFailure'],
        'authorize' => ['App\Services\PaymentGateway\NotificationAction', 'onAuthorize'],
        'refund' => ['App\Services\PaymentGateway\NotificationAction', 'onRefund'],
        'partial_refund' => ['App\Services\PaymentGateway\NotificationAction', 'onPartialRefund'],
        'chargeback' => ['App\Services\PaymentGateway\NotificationAction', 'onChargeback'],
        'partial_chargeback' => ['App\Services\PaymentGateway\NotificationAction', 'onPartialChargeback'],
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
