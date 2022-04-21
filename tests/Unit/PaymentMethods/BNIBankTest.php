<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\BNIBank;
use Tests\TestCase;

class BNIBankTest extends TestCase
{
    /**
     * @test getSnapName function should return 'bni_va'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $bni = new BNIBank();
        $this->assertEquals('bni_va', $bni->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bni = new BNIBank();
        $this->assertEquals('bank_transfer', $bni->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bni = new BNIBank();
        $this->assertEquals([
            'bank' => 'bni',
        ], $bni->getApiPaymentPayload());
    }
}
