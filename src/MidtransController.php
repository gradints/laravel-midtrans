<?php

namespace Gradints\LaravelMidtrans;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class MidtransController extends Controller
{
    use ValidatesRequests;

    public function paymentNotification(MidtransTransactionNotificationRequest $request)
    {
        // Validate request authenticity (compare signature)
        // If not authentic, throw error 422 invalid signature

        // Call external function
        $paymentNotification = Config::get('midtrans.notification_actions.payment_notification');
        if (count($paymentNotification)) {
            [$class, $function] = $paymentNotification;
            $class::$function($request->all());
        }
    }

    public function recurringNotification (MidtransTransactionNotificationRequest $request)
    {
        // Validate request authenticity (compare signature)
        // If not authentic, throw error 422 invalid signature

        // Call external function
        $recurringNotification = Config::get('midtrans.notification_actions.recurring_notification');
        if (count($recurringNotification)) {
            [$class, $function] = $recurringNotification;
            $class::$function($request->all());
        }
    }

    // public function payAccountNotification (Request $request)
    // {

    // }
}
