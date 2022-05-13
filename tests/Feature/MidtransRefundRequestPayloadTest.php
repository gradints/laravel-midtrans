<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Tests\TestCase;

class MidtransRefundRequestPayloadTest extends TestCase
{
    /**
     * @test refundTransaction
     */
    public function it_provides_function_to_generate_request_payload_for_refund()
    {
        $refundKey = 'reference1';
        $amount = 100_000;
        $reason = 'Order cancel';

        $midtrans = new Midtrans();
        $midtrans->setRefund($refundKey, $amount, $reason);

        $expected = [
            'refund_key' => $refundKey,
            'amount' => $amount,
            'reason' => $reason,
        ];

        $this->assertEquals($expected, $midtrans->generateRequestPayloadForRefund());
    }
}
