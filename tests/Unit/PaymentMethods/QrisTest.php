<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Qris;
use Tests\TestCase;

class QrisTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'qris'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $qris = new Qris();
        $this->assertEquals('qris', $qris->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $qris = new Qris('gopay');
        $this->assertEquals(['acquirer' => 'gopay'], $qris->getPaymentPayload());

        $qris->setAcquirer('shopee');
        $this->assertEquals(['acquirer' => 'shopee'], $qris->getPaymentPayload());
    }
}