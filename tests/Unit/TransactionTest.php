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

    /** @test constructor and getter for Items */
    public function test_it_provides_constructor_parameter_and_getter_for_items()
    {
        $orderId = 'TR/20220401/0001';
        $grossAmount = 100_000;
        $items = [
            [
                'id' => '1',
                'price' => 100_000,
                'name' => 'Pulsa Indosat Rp 100,000',
            ],
            [
                'id' => '2',
                'price' => 3_000,
                'name' => 'Indomie Goreng',
            ],
        ];
        $transaction = new Transaction($orderId, $grossAmount, $items);

        $this->assertEquals($items, $transaction->getItems());
    }
}
