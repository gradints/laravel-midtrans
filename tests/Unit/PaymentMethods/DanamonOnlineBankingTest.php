<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\DanamonOnlineBanking;
use Tests\TestCase;

class DanamonOnlineBankingTest extends TestCase
{
    /**
     * @test getSnapName function should return 'danamon_online'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $danamon = new DanamonOnlineBanking();
        $this->assertEquals('danamon_online', $danamon->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'danamon_online'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $danamon = new DanamonOnlineBanking();
        $this->assertEquals('danamon_online', $danamon->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $danamon = new DanamonOnlineBanking();
        $this->assertEquals([], $danamon->getApiPaymentPayload());
    }
}