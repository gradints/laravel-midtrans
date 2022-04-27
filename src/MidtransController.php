<?php

namespace Gradints\LaravelMidtrans;

use Gradints\LaravelMidtrans\Jobs\GetLatestTransactionStatus;
use Gradints\LaravelMidtrans\Validations\Requests\PayAccountNotificationRequest;
use Gradints\LaravelMidtrans\Validations\Requests\PaymentNotificationRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class MidtransController extends Controller
{
    use ValidatesRequests;

    // Best Practices to Handle Notification
    // https://api-docs.midtrans.com/?php#best-practices-to-handle-notification

    /**
     * Temporary ignore midtrans response and send request to get latest status instead.
     *
     * @return void
     */
    public function paymentNotification(PaymentNotificationRequest $request)
    {
        GetLatestTransactionStatus::dispatch($request['order_id']);
    }

    public function recurringNotification(PaymentNotificationRequest $request)
    {
        // Call external function
        // $recurringNotification = config('midtrans.recurring_notification');
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
