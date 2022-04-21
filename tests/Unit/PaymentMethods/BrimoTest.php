<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Brimo;
use Tests\TestCase;

class BrimoTest extends TestCase
{
    /**
     * @test getSnapName function should return 'bri_epay'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $brimo = new Brimo();
        $this->assertEquals('bri_epay', $brimo->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'bri_epay'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $brimo = new Brimo();
        $this->assertEquals('bri_epay', $brimo->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $brimo = new Brimo();
        $this->assertEquals([], $brimo->getApiPaymentPayload());
    }
}
