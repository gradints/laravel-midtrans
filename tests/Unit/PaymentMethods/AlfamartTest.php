<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Alfamart;
use Tests\TestCase;

class AlfamartTest extends TestCase
{
     /**
     * @test getSnapName function should return 'alfamart'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $alfamart = new Alfamart();
        $this->assertEquals('alfamart', $alfamart->getSnapName());
    }
    
    /**
     * @test getApiPaymentType function should return 'alfamart'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $alfamart = new Alfamart();
        $this->assertEquals('alfamart', $alfamart->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $alfamart = new Alfamart();
        $this->assertEquals(['store' => 'alfamart'], $alfamart->getApiPaymentPayload());

        $text1 = 'Thanks for shopping with us!,';
        $text2 = 'Like us on our Facebook page,';
        $text3 = 'and get 10% discount on your next purchase.';

        $alfamart->setAlfamartFreeText($text1);
        $this->assertEquals([
            'store' => 'alfamart',
            'alfamart_free_text_1' => $text1,
        ], $alfamart->getApiPaymentPayload());

        $alfamart->setAlfamartFreeText($text1, $text2, $text3);

        $this->assertEquals([
            'store' => 'alfamart',
            'alfamart_free_text_1' => $text1,
            'alfamart_free_text_2' => $text2,
            'alfamart_free_text_3' => $text3,
        ], $alfamart->getApiPaymentPayload());

    }
}