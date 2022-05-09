<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Brimo;
use Tests\TestCase;

class BrimoTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'bri_epay'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $brimo = new Brimo();
        $this->assertEquals('bri_epay', $brimo->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $brimo = new Brimo();
        $this->assertEquals([], $brimo->getPaymentPayload());
    }
}
