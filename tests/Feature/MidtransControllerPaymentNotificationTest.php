<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Jobs\GetLatestTransactionStatus;
use Gradints\LaravelMidtrans\Validations\Requests\PaymentNotificationRequest;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class MidtransControllerPaymentNotificationTest extends TestCase
{
    public function test_it_should_dispatch_jobs_with_order_id()
    {
        Bus::fake();

        $request = [
            'order_id' => 'order-id',
        ];

        $this->partialMock(PaymentNotificationRequest::class, function ($mock) use ($request) {
            $mock->shouldReceive('all')->withAnyArgs()->andReturn($request);
        });

        $url = route('midtrans.payment-notification');
        $this->postJson($url)->assertOk();

        Bus::assertDispatched(GetLatestTransactionStatus::class, fn ($job) =>
            $job->orderId === $request['order_id']
        );
    }

    // TODO recurring notification
    // TODO pay acount
}
