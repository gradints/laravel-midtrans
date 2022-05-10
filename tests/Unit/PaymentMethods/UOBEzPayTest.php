<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\UOBEzPay;
use Tests\TestCase;

class UOBEzPayTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'uob_ezpay'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $uob = new UOBEzPay();
        $this->assertEquals('uob_ezpay', $uob->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $uob = new UOBEzPay();
        $this->assertEquals(null, $uob->getPaymentPayload());
    }
}
