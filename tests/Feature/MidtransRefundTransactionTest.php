<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Midtrans\Transaction as MidtransTransaction;
use Mockery\MockInterface;
use Tests\TestCase;

class MidtransRefundTransactionTest extends TestCase
{
    /**
     * @test
     */
    public function it_calls_midtrans_refund_transaction_with_refund_payload()
    {
        $orderId = 'TR-2022-02-21_188';

        $refundKey = 'reference1';
        $amount = 100_000;
        $reason = 'Order cancel';

        $response = (object)[
            'status_code' => 200,
            'status_message' => 'Success, refund request is approved by the bank',
            'transaction_id' => 'fake_id',
            'order_id' => $orderId,
        ];

        $this->mock(
            'alias:' . MidtransTransaction::class,
            function (MockInterface $mock) use ($response, $refundKey, $amount, $reason) {
                $mock->shouldReceive('refund')
                    ->once()
                    ->with($response->order_id, [
                        'refund_key' => $refundKey,
                        'amount' => $amount,
                        'reason' => $reason,
                    ])
                    ->andReturn($response);
            }
        );

        $midtrans = new Midtrans();
        $midtrans->setRefund($refundKey, $amount, $reason);

        $this->assertEquals($response, $midtrans->refundTransaction($orderId));
    }

    /**
     * @test
     */
    public function it_calls_midtrans_refund_direct_transaction_with_refund_payload()
    {
        $orderId = 'TR-2022-02-21_188';

        $refundKey = 'reference1';
        $amount = 100_000;
        $reason = 'Order cancel';

        $response = (object)[
            'status_code' => 200,
            'status_message' => 'Success, refund request is approved by the bank',
            'transaction_id' => 'fake_id',
            'order_id' => $orderId,
        ];

        $this->mock(
            'alias:' . MidtransTransaction::class,
            function (MockInterface $mock) use ($response, $refundKey, $amount, $reason) {
                $mock->shouldReceive('refundDirect')
                    ->once()
                    ->with($response->order_id, [
                        'refund_key' => $refundKey,
                        'amount' => $amount,
                        'reason' => $reason,
                    ])
                    ->andReturn($response);
            }
        );

        $midtrans = new Midtrans();
        $midtrans->setRefund($refundKey, $amount, $reason);

        $this->assertEquals($response, $midtrans->refundDirectTransaction($orderId));
    }
}
