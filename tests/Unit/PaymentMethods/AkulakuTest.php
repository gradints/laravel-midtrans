<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Akulaku;
use Tests\TestCase;

class AkulakuTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'akulaku'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $akulaku = new Akulaku();
        $this->assertEquals('akulaku', $akulaku->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $akulaku = new Akulaku();
        $this->assertEquals([], $akulaku->getPaymentPayload());
    }
}
