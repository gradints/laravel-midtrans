<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\BCAKlikPay;
use Tests\TestCase;

class BCAKlikPayTest extends TestCase
{
    /**
     * @test getDescription.
     */
    public function it_provides_a_getter_for_description()
    {
        $bca = new BCAKlikPay();
        $description = 'Transaction #00001';
        $bca->setDescription($description);
        $this->assertEquals($description, $bca->getDescription());
    }

    /**
     * @test getPaymentType function should return 'bca_klikpay'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bca = new BCAKlikPay();
        $this->assertEquals('bca_klikpay', $bca->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bca = new BCAKlikPay();
        $description = 'Transaction #00001';
        $bca->setDescription($description);

        $this->assertEquals([
            'description' => $description,
        ], $bca->getPaymentPayload());
    }
}
