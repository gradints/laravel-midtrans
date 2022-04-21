<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\CreditCard;
use Tests\TestCase;

class CreditCardTest extends TestCase
{
    /**
     * @test getSnapName function should return 'credit_card'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $creditCard = new CreditCard();
        $this->assertEquals('credit_card', $creditCard->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'credit_card'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $creditCard = new CreditCard();
        $this->assertEquals('credit_card', $creditCard->getApiPaymentType());
    }

    /**
     * @test getTokenId function should return token id
     */
    public function it_provides_a_getter_for_token_id()
    {
        $tokenId = '4811117d16c884-2cc7-4624-b0a8-10273b7f6cc8';
        $creditCard = new CreditCard();
        $creditCard->setTokenId($tokenId);

        $this->assertEquals($tokenId, $creditCard->getTokenId());
    }

    /**
     * @test getBank function shoild return BNI
     */
    public function it_provides_a_getter_for_bank()
    {
        $creditCard = new CreditCard();
        $creditCard->setBank('BNI');

        $this->assertEquals('BNI', $creditCard->getBank());
    }

    /**
     * @test getInstallmentTerm function should return installment term
     */
    public function it_provides_a_getter_for_installment_term()
    {
        $creditCard = new CreditCard();
        $creditCard->setInstallmentTerm(12);

        $this->assertEquals(12, $creditCard->getInstallmentTerm());
    }

    /**
     * @test getBins function shoild return array
     */
    public function it_provides_getter_for_bins()
    {
        $creditCard = new CreditCard();
        $creditCard->setBins(4811, 5233);

        return $this->assertEquals([4811, 5233], $creditCard->getBins());
    }

    /**
     * @test getType function should return authorize
     */
    public function it_provides_getter_type()
    {
        $creditCard = new CreditCard();
        $creditCard->setType('authorize');

        return $this->assertEquals('authorize', $creditCard->getType());
    }

    /**
     * @test getSaveTokenId function should return bool
     */
    public function it_provides_getter_for_save_token_id()
    {
        $creditCard = new CreditCard();
        $creditCard->setSaveTokenId(true);

        $this->assertTrue($creditCard->getSaveTokenId());
    }

    /**
     * @test getApiPaymentPayload function should return credit card object.
     * https://api-docs.midtrans.com/?php#credit-card-object
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $tokenId = '4811117d16c884-2cc7-4624-b0a8-10273b7f6cc8';
        $creditCard = new CreditCard($tokenId);
        $this->assertEquals(['token_id' => $tokenId], $creditCard->getApiPaymentPayload());

        $creditCard->setBank('BNI');
        $creditCard->setInstallmentTerm(6);
        $creditCard->setBins(4811, 5233);
        $creditCard->setType('authorize');
        $creditCard->setSaveTokenId(true);

        $this->assertEquals([
            'token_id' => $tokenId,
            'bank' => 'BNI',
            'installment_term' => 6,
            'bins' => [4811, 5233],
            'type' => 'authorize',
            'save_token_id' => true,
        ], $creditCard->getApiPaymentPayload());
    }
}
