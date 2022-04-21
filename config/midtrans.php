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
     */
    // 'notification_routes' => [
        // Address where Midtrans will send the notification via HTTP Post request.
        // 'payment_notification' => '/midtrans/payment-notification',
        // Address where Midtrans will send the recurring notification via HTTP Post request.
        // 'recurring_notification' => '/midtrans/recurring-notification',
        // Address where Midtrans will send the pay account status notification via HTTP Post request
        // 'pay_account_notification' => '/midtrans/recurring-notification',
    // ],
    'notification_actions' => [
        // Function to run when Midtrans send HTTP Post request to payment notification route
        'payment_notification' => ['App\Models\Purchase', 'updatePaymentStatus'],
        // Function to run when Midtrans send HTTP Post request to recurring notification route
        'recurring_notification' => ['App\Models\User', 'updateMembershipStatus'],
        // Function to run when Midtrans send HTTP Post request to pay account notification route
        'pay_account_notification' => '',
    ],

    /*
     |--------------------------------------------------------------------------
     | Registering class payment method
     |--------------------------------------------------------------------------
     |
     | TODO description
     |
     */

    'payment_methods' => [
        'snap' => [
            // Gradints\LaravelMidtrans\Models\PaymentMethods\BCACreditCard::class
            // Gradints\LaravelMidtrans\Models\PaymentMethods\MandiriCreditCard::class
            // Gradints\LaravelMidtrans\Models\PaymentMethods\PermataCreditCard::class
        ],
        'api' => [
            // Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank::class
            // Gradints\LaravelMidtrans\Models\PaymentMethods\BCABank::class
            // Gradints\LaravelMidtrans\Models\PaymentMethods\MandiriBank::class
        ],
    ],


];
