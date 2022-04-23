<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank;
use Tests\TestCase;

class PermataBankTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'bank_transfer'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $permata = new PermataBank();
        $this->assertEquals('bank_transfer', $permata->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $permata = new PermataBank();
        $this->assertEquals([
            'bank' => 'permata',
        ], $permata->getPaymentPayload());
    }
}
