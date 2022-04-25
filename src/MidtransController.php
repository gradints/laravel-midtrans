<?php

namespace Gradints\LaravelMidtrans;

use Gradints\LaravelMidtrans\Enums\TransactionStatus;
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

    public function paymentNotification(PaymentNotificationRequest $request)
    {
        // TODO ignore status_code other than 200
        // TODO ignore transaction status if somehow Midtrans notification delayed or unordered
        // TODO check fraud status

        return Midtrans::executeActionByStatus($request->transaction_status, $request->all());
    }

    public function recurringNotification(PaymentNotificationRequest $request)
    {
        // Call external function
        // $recurringNotification = Config::get('midtrans.recurring_notification');
        // if (count($recurringNotification)) {
        //     [$class, $function] = $recurringNotification;
        //     $class::$function($request->all());
        // }
    }

    public function payAccountNotification(PayAccountNotificationRequest $request)
    {
        // do something
    }
}
