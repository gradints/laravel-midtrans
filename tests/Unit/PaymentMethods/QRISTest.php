<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\QRIS;
use Tests\TestCase;

class QRISTest extends TestCase
{
    /**
     * @test setAcquired and getAcquired.
     */
    public function it_provides_a_setter_and_getter_for_acquirer()
    {
        $qris = new QRIS();
        $this->assertEquals('gopay', $qris->getAcquirer());

        $qris->setAcquirer('shopee');
        $this->assertEquals('shopee', $qris->getAcquirer());
    }

    /**
     * @test getPaymentType function should return 'qris'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $qris = new QRIS();
        $this->assertEquals('qris', $qris->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $qris = new QRIS('gopay');
        $this->assertEquals(['acquirer' => 'gopay'], $qris->getPaymentPayload());

        $qris->setAcquirer('shopee');
        $this->assertEquals(['acquirer' => 'shopee'], $qris->getPaymentPayload());
    }
}
