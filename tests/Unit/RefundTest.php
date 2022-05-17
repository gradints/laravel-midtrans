<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Models\Refund;
use Tests\TestCase;

class RefundTest extends TestCase
{
    public function test_a_setter_and_getter_for_refund_key()
    {
        $refundKey = 'reference1';

        $refund = new Refund();

        $this->assertNull($refund->getRefundKey());

        $refund->setRefundKey($refundKey);
        $this->assertEquals($refundKey, $refund->getRefundKey());
    }

    public function test_a_setter_and_getter_for_amount()
    {
        $amount = 1_000_000;

        $refund = new Refund();

        $this->assertNull($refund->getAmount());

        $refund->setAmount($amount);
        $this->assertEquals($amount, $refund->getAmount());
    }

    public function test_a_setter_and_getter_for_reason()
    {
        $reason = 'Cancel order';

        $refund = new Refund();

        $this->assertNull($refund->getReason());

        $refund->setReason($reason);
        $this->assertEquals($reason, $refund->getReason());
    }

    public function test_a_function_generate_payload()
    {
        $refundKey = 'reference1';
        $amount = 100_000;
        $reason = 'Order cancel';

        $refund = new Refund();
        $this->assertEquals([
            'refund_key' => null,
            'amount' => null,
            'reason' => null,
        ], $refund->generatePayload());

        $refund = new Refund($refundKey, $amount, $reason);
        $this->assertEquals([
            'refund_key' => $refundKey,
            'amount' => $amount,
            'reason' => $reason,
        ], $refund->generatePayload());
    }
}
