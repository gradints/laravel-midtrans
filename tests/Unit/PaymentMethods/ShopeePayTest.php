<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\ShopeePay;
use Tests\TestCase;

class ShopeepayTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'shopeepay'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $shopee = new ShopeePay();
        $this->assertEquals('shopeepay', $shopee->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return Shopeepay object.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $shopee = new ShopeePay();
        $this->assertEquals([
            'callback_url' => config('midtrans.redirect.finish'),
        ], $shopee->getPaymentPayload());
    }
}
