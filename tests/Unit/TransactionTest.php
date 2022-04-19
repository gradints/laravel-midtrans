<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Models\Transaction;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /** @test getter orderId */
    public function test_it_provides_a_getter_for_order_id()
    {
        $orderId = 'TR/20220401/0001';
        $grossAmount = 100_000;
        $transaction = new Transaction($orderId, $grossAmount);

        $this->assertEquals('TR-20220401-0001', $transaction->getOrderId());
    }

    /** @test getter grossAmount */
    public function test_it_provides_a_getter_for_gross_amount()
    {
        $orderId = 'TR/20220401/0001';
        $grossAmount = 100_000;
        $transaction = new Transaction($orderId, $grossAmount);

        $this->assertEquals(100_000, $transaction->getGrossAmount());
    }
}
