<?php

namespace Gradints\LaravelMidtrans;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config as MidtransConfig;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/midtrans.php', 'midtrans');
        $this->loadRoutesFrom(__DIR__ . '/MidtransRoutes.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/midtrans.php' => config_path('midtrans.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/NotificationAction.php' => app_path('Services/PaymentGateway/NotificationAction.php'),
        ], 'action');

        // https://docs.midtrans.com/en/snap/integration-guide?id=sample-request
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = app()->environment('production');
        MidtransConfig::$isSanitized = config('midtrans.use_sanitizer', false);
        MidtransConfig::$is3ds = config('midtrans.enable_3ds', false);
    }
}
