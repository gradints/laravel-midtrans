<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank;
use Tests\TestCase;

class PermataBankTest extends TestCase
{
    /**
     * @test getSnapName function should return 'permata_va'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $permata = new PermataBank();
        $this->assertEquals('permata_va', $permata->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $permata = new PermataBank();
        $this->assertEquals('bank_transfer', $permata->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $permata = new PermataBank();
        $this->assertEquals([
            'bank' => 'permata',
        ], $permata->getApiPaymentPayload());
    }
}
