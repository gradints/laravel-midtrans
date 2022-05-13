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
        $refund->setRefundKey($refundKey);

        $this->assertEquals($refundKey, $refund->getRefundKey());
    }

    public function test_a_setter_and_getter_for_amount()
    {
        $amount = 1_000_000;

        $refund = new Refund();
        $refund->setAmount($amount);

        $this->assertEquals($amount, $refund->getAmount());
    }

    public function test_a_setter_and_getter_for_reason()
    {
        $reason = 'Cancel order';

        $refund = new Refund();
        $refund->setReason($reason);

        $this->assertEquals($reason, $refund->getReason());
    }
}
