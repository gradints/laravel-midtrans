<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\BCABank;
use Tests\TestCase;

class BCABankTest extends TestCase
{
    /**
     * @test getSnapName function should return 'bca_va'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $bca = new BCABank();
        $this->assertEquals('bca_va', $bca->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bca = new BCABank();
        $this->assertEquals('bank_transfer', $bca->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bca = new BCABank();
        $this->assertEquals([
            'bank' => 'bca',
        ], $bca->getApiPaymentPayload());
    }
}
