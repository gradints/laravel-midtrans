<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Akulaku;
use Tests\TestCase;

class AkulakuTest extends TestCase
{
    /**
     * @test getSnapName function should return 'akulaku'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $akulaku = new Akulaku();
        $this->assertEquals('akulaku', $akulaku->getSnapName());
    } 

    /**
     * @test getApiPaymentType function should return 'akulaku'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $akulaku = new Akulaku();
        $this->assertEquals('akulaku', $akulaku->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $akulaku = new Akulaku();
        $this->assertEquals([], $akulaku->getApiPaymentPayload());
    }
}