<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Kredivo;
use Tests\TestCase;

class KredivoTest extends TestCase
{
    /**
     * @test getApiPaymentType function should return 'kredivo'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $kredivo = new Kredivo();
        $this->assertEquals('kredivo', $kredivo->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $kredivo = new Kredivo();
        $this->assertEquals([], $kredivo->getApiPaymentPayload());
    }
}