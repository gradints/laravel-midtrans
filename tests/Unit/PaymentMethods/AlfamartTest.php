<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\Alfamart;
use Tests\TestCase;

class AlfamartTest extends TestCase
{
    /**
     * @test getPaymentType function should return 'alfamart'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $alfamart = new Alfamart();
        $this->assertEquals('cstore', $alfamart->getPaymentType());
    }

    /**
     * @test getPaymentPayload function should return array.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $alfamart = new Alfamart();
        $this->assertEquals(['store' => 'alfamart'], $alfamart->getPaymentPayload());

        $text1 = 'Thanks for shopping with us!,';
        $text2 = 'Like us on our Facebook page,';
        $text3 = 'and get 10% discount on your next purchase.';

        $alfamart->setAlfamartFreeText($text1);
        $this->assertEquals([
            'store' => 'alfamart',
            'alfamart_free_text_1' => $text1,
        ], $alfamart->getPaymentPayload());

        $alfamart->setAlfamartFreeText($text1, $text2, $text3);

        $this->assertEquals([
            'store' => 'alfamart',
            'alfamart_free_text_1' => $text1,
            'alfamart_free_text_2' => $text2,
            'alfamart_free_text_3' => $text3,
        ], $alfamart->getPaymentPayload());
    }
}
