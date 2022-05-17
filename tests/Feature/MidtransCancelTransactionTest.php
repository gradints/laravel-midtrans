<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Midtrans\Transaction as MidtransTransaction;
use Mockery\MockInterface;
use Tests\TestCase;

class MidtransCancelTransactionTest extends TestCase
{
    /**
     * @test
     */
    public function it_calls_midtrans_cancel_transaction_without_payload()
    {
        $orderId = 'TR-2022-09-23_199';

        $response = (object)[
            'status_code' => 200,
            'status_message' => 'Success, transaction is canceled',
            'order_id' => $orderId,
            'transaction_id' => 'fake_id',
            'transaction_status' => 'cancel',
        ];

        $this->mock(
            'alias:' . MidtransTransaction::class,
            function (MockInterface $mock) use ($response) {
                $mock->shouldReceive('cancel')
                    ->once()
                    ->with($response->order_id)
                    ->andReturn($response);
            }
        );

        $this->assertEquals($response, Midtrans::cancelTransaction($orderId));
    }
}
