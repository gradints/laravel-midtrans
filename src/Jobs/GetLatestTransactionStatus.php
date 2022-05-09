<?php

namespace Gradints\LaravelMidtrans\Jobs;

use Gradints\LaravelMidtrans\Midtrans;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetLatestTransactionStatus implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public string $orderId)
    {
    }

    public function handle()
    {
        Midtrans::getTransactionStatus($this->orderId);
    }
}
