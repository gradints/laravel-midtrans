<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Qris;
use Tests\TestCase;

class QrisTest extends TestCase
{
    /**
     * @test getApiPaymentType function should return 'qris'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $qris = new Qris();
        $this->assertEquals('qris', $qris->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $qris = new Qris();
        $this->assertEquals(['acquirer' => 'gopay'], $qris->getApiPaymentPayload());

        $qris->setAcquirer('shopee');
        $this->assertEquals(['acquirer' => 'shopee'], $qris->getApiPaymentPayload());
    }
}