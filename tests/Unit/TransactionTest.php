<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Exceptions\InvalidOrderIdFormatException;
use Gradints\LaravelMidtrans\Models\Transaction;
use Illuminate\Support\Str;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_it_provides_a_setter_and_getter_for_order_id()
    {
        $orderId = 'TR-0001';
        $grossAmount = 100_000;
        $transaction = new Transaction($orderId, $grossAmount);
        $this->assertEquals($orderId, $transaction->getOrderId());

        $newOrderId = 'TR-0002';
        $transaction->setOrderId($newOrderId);
        $this->assertEquals($newOrderId, $transaction->getOrderId());
    }

    public function test_it_provides_a_setter_and_getter_for_gross_amount()
    {
        $orderId = 'TR-0001';
        $grossAmount = 100_000;
        $transaction = new Transaction($orderId, $grossAmount);
        $this->assertEquals($grossAmount, $transaction->getGrossAmount());

        $newGrossAmount = 25_000;
        $transaction->setGrossAmount($newGrossAmount);
        $this->assertEquals($newGrossAmount, $transaction->getGrossAmount());
    }

    public function test_it_provides_constructor_parameter_and_getter_for_items()
    {
        $orderId = 'TR-0001';
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

    public function test_it_should_throw_exception_if_order_id_is_more_than_50_characters()
    {
        $this->expectException(InvalidOrderIdFormatException::class);

        $orderId = Str::random(51);
        $grossAmount = 10_000;

        new Transaction($orderId, $grossAmount);
    }

    public function test_it_should_throw_exception_if_order_id_contains_unsupported_characters()
    {
        $this->expectException(InvalidOrderIdFormatException::class);

        $orderId = 'TR/0001/0001';
        $grossAmount = 10_000;

        new Transaction($orderId, $grossAmount);
    }
}
