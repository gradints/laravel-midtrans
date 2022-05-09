<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\BRIBank;
use Tests\TestCase;

class BRIBankTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bri = new BRIBank();
        $this->assertEquals('bank_transfer', $bri->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bri = new BRIBank();
        $this->assertEquals([
            'bank' => 'bri',
        ], $bri->getPaymentPayload());
    }
}
