<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\DanamonOnlineBanking;
use Tests\TestCase;

class DanamonOnlineBankingTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'danamon_online'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $danamon = new DanamonOnlineBanking();
        $this->assertEquals('danamon_online', $danamon->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $danamon = new DanamonOnlineBanking();
        $this->assertEquals([], $danamon->getPaymentPayload());
    }
}
