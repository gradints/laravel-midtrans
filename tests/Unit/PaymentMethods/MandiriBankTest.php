<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\MandiriBank;
use Tests\TestCase;

class MandiriBankTest extends TestCase
{
    /**
     * @test getSnapName function should return 'echannel'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $mandiri = new MandiriBank();
        $this->assertEquals('echannel', $mandiri->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'echannel'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $mandiri = new MandiriBank();
        $this->assertEquals('echannel', $mandiri->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $mandiri = new MandiriBank();
        $this->assertEquals([
            'bill_info1' => 'Payment:',
            'bill_info2' => 'Online purchase',
        ], $mandiri->getApiPaymentPayload());

        $billInfo1 = 'Gradin';
        $billInfo2 = 'gradin.co.id';
        $mandiri->setBillInfo($billInfo1, $billInfo2);

        $this->assertEquals([
            'bill_info1' => $billInfo1,
            'bill_info2' => $billInfo2,
        ], $mandiri->getApiPaymentPayload());

        $mandiri->setBillInfo('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');
        $this->assertEquals([
            'bill_info1' => 'A',
            'bill_info2' => 'B',
            'bill_info3' => 'C',
            'bill_info4' => 'D',
            'bill_info5' => 'E',
            'bill_info6' => 'F',
            'bill_info7' => 'G',
            'bill_info8' => 'H',
        ], $mandiri->getApiPaymentPayload());
    }
}
