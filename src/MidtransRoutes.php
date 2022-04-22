<?php

use Gradints\LaravelMidtrans\MidtransController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::controller(MidtransController::class)->group(function () {
    Route::post('/midtrans/payment-notification', 'paymentNotification')
        ->name('midtrans.payment-notification');

    Route::post('/midtrans/recurring-notification', 'recurringNotification')
        ->name('midtrans.recurring-notification');

    Route::post('/midtrans/pay-account-notification', 'payAccountNotification')
        ->name('midtrans.pay-account-notification');
});
