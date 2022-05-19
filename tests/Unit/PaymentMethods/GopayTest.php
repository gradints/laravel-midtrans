<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Gopay;
use Tests\TestCase;

class GopayTest extends TestCase
{
    /**
     * @test getEnableCallback
     */
    public function it_provides_a_setter_and_getter_for_enabled_callback()
    {
        $gopay = new Gopay();
        $this->assertNotTrue($gopay->getEnableCallback());

        $gopay->enableCallback();
        $this->assertTrue($gopay->getEnableCallback());

        $gopay->dontEnableCallback();
        $this->assertNotTrue($gopay->getEnableCallback());
    }

    /**
     * @test getPaymentType function should return 'gopay'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $gopay = new Gopay();
        $this->assertEquals('gopay', $gopay->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return Gopay object.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $gopay = new Gopay();
        $gopay->enableCallback();
        $this->assertEquals([
            'enable_callback' => true,
        ], $gopay->getPaymentPayload());
    }
}
