<?php

namespace Gradints\LaravelMidtrans;

use Gradints\LaravelMidtrans\Traits\CallFunction;
use Gradints\LaravelMidtrans\Validations\Requests\PayAccountNotificationRequest;
use Gradints\LaravelMidtrans\Validations\Requests\PaymentNotificationRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class MidtransController extends Controller
{
    use ValidatesRequests;
    use CallFunction;

    // Best Practices to Handle Notification
    // https://api-docs.midtrans.com/?php#best-practices-to-handle-notification

    // TODO ignore status_code other than 200

    public function paymentNotification(PaymentNotificationRequest $request): void
    {
        // Call external function
        $paymentNotification = MidtransGetTransactionStatus::getAction(
            $request->transaction_status,
            $request->fraud_status
        );

        self::callFunction($paymentNotification, $request->all());
    }

    public function recurringNotification(PaymentNotificationRequest $request): void
    {
        // Call external function
        $recurringNotification = Config::get('midtrans.recurring_notification');
        if (count($recurringNotification)) {
            [$class, $function] = $recurringNotification;
            $class::$function($request->all());
        }
    }

    public function payAccountNotification(PayAccountNotificationRequest $request): void
    {
        // do something
    }
}
