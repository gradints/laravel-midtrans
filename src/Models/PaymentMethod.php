<?php

namespace Gradints\LaravelMidtrans\Models;

use Illuminate\Support\Facades\Config;

abstract class PaymentMethod
{
    public function isUsingSnap(): bool
    {
        $class = get_class($this);

        $paymentMethods = Config::get('midtrans.payment_methods.snap');
        
        return in_array($class, $paymentMethods);
    }

    public function isUsingApi(): bool
    {
        $class = get_class($this);

        $paymentMethods = Config::get('midtrans.payment_methods.api');
        
        return in_array($class, $paymentMethods);
    }
}
