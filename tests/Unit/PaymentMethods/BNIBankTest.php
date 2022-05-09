<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\BNIBank;
use Tests\TestCase;

class BNIBankTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bni = new BNIBank();
        $this->assertEquals('bank_transfer', $bni->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bni = new BNIBank();
        $this->assertEquals([
            'bank' => 'bni',
        ], $bni->getPaymentPayload());
    }
}
