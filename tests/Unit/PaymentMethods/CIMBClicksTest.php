<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\CIMBClicks;
use Tests\TestCase;

class CIMBClicksTest extends TestCase
{
    /**
     * @test getDescription.
     */
    public function it_provides_a_getter_for_description()
    {
        $cimb = new CIMBClicks();
        $description = 'Transaction #00001';
        $cimb->setDescription($description);
        $this->assertEquals($description, $cimb->getDescription());
    }

    /**
     * @test getSnapName function should return 'cimb_clicks'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $cimb = new CIMBClicks();
        $this->assertEquals('cimb_clicks', $cimb->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'cimb_clicks'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $cimb = new CIMBClicks();
        $this->assertEquals('cimb_clicks', $cimb->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $cimb = new CIMBClicks();
        $description = 'Transaction #00001';
        $cimb->setDescription($description);

        $this->assertEquals([
            'description' => $description,
        ], $cimb->getApiPaymentPayload());
    }
}
