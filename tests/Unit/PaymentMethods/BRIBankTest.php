<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\BRIBank;
use Tests\TestCase;

class BRIBankTest extends TestCase
{
    /**
     * @test getSnapName function should return 'bri_va'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $bri = new BRIBank();
        $this->assertEquals('bri_va', $bri->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bri = new BRIBank();
        $this->assertEquals('bank_transfer', $bri->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bri = new BRIBank();
        $this->assertEquals([
            'bank' => 'bri',
        ], $bri->getApiPaymentPayload());
    }
}
