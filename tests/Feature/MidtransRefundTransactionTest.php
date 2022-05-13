<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Gradints\LaravelMidtrans\Models\PaymentMethods\CreditCard;
use Gradints\LaravelMidtrans\Models\PaymentMethods\Gopay;
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

        $creditCard = new CreditCard();
        $refundKey = 'reference1';
        $amount = 100_000;
        $reason = 'Order cancel';
        $bank = 'bni';

        $response = (object)[
            'status_code' => 200,
            'status_message' => 'Success, refund request is approved by the bank',
            'order_id' => $orderId,
            'transaction_id' => 'fake_id',
            'transaction_status' => 'refund',
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

        $this->assertEquals($response, Midtrans::refundTransaction(
            $creditCard,
            $orderId,
            $refundKey,
            $amount,
            $reason,
            $bank,
        ));
    }

    /**
     * @test
     */
    public function it_calls_midtrans_refund_direct_transaction_with_refund_payload()
    {
        $orderId = 'TR-2022-02-21_188';

        $gopay = new Gopay();
        $refundKey = 'reference1';
        $amount = 100_000;
        $reason = 'Order cancel';

        $response = (object)[
            'status_code' => 200,
            'status_message' => 'Success, refund request is approved by the bank',
            'transaction_id' => 'fake_id',
            'transaction_status' => 'refund',
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

        $this->assertEquals($response, Midtrans::refundTransaction(
            $gopay,
            $orderId,
            $refundKey,
            $amount,
            $reason,
        ));
    }
}
