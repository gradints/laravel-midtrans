<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\BCABank;
use Tests\TestCase;

class BCABankTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bca = new BCABank();
        $this->assertEquals('bank_transfer', $bca->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bca = new BCABank();
        $this->assertEquals([
            'bank' => 'bca',
        ], $bca->getPaymentPayload());
    }
}
