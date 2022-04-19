<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Models\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    /**
     * Test getInvoiceNumber()
     *
     * @return void
     */
    public function testGetInvoiceNumber()
    {
        $orderId = 'TR/20220401/0001';
        $grossAmount = 100_000;
        $transaction = new Transaction($orderId, $grossAmount);

        $this->assertEquals('TR-20220401-0001', $transaction->getOrderId());
    }

    /**
     * Test GetGrossAmount()
     *
     * @return void
     */
    public function testGrossAmount()
    {
        $orderId = 'TR/20220401/0001';
        $grossAmount = 100_000;
        $transaction = new Transaction($orderId, $grossAmount);

        $this->assertEquals(100_000, $transaction->getGrossAmount());
    }
}
