<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Indomaret;
use Tests\TestCase;

class IndomaretTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'indomaret'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $indomaret = new Indomaret();
        $this->assertEquals('indomaret', $indomaret->getPaymentType());
    }

    /**
     * @test getMessage function should return 'Tiket1 transaction'
     */
    public function it_provides_a_getter_for_message()
    {
        $indomaret = new Indomaret();
        $indomaret->setMessage('Tiket1 transaction');

        $this->assertEquals('Tiket1 transaction', $indomaret->getMessage());
    }

    /**
     * @test getPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $indomaret = new Indomaret();
        $this->assertEquals([
            'store' => 'indomaret',
        ], $indomaret->getPaymentPayload());

        $indomaret->setMessage('Tiket1 transaction');
        $this->assertEquals([
            'store' => 'indomaret',
            'message' => 'Tiket1 transaction',
        ], $indomaret->getPaymentPayload());
    }
}
