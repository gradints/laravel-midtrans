<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Gopay;
use Tests\TestCase;

class GopayTest extends TestCase
{
    /**
     * @test getEnableCallback
     */
    public function it_provides_a_getter_for_enabled_callback()
    {
        $gopay = new Gopay();
        $this->assertNotTrue($gopay->getEnableCallback());

        $gopay->setEnableCallback(true);
        $this->assertTrue($gopay->getEnableCallback());
    }

    /**
     * @test getSnapName function should return 'gopay'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $gopay = new Gopay();
        $this->assertEquals('gopay', $gopay->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'gopay'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $gopay = new Gopay();
        $this->assertEquals('gopay', $gopay->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return Gopay object.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $gopay = new Gopay();
        $gopay->setEnableCallback(true);
        $this->assertEquals([
            'enable_callback' => true,
        ], $gopay->getApiPaymentPayload());
    }
}
