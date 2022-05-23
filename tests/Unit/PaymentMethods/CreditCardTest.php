<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\CreditCard;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class CreditCardTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    
        Config::set('midtrans.enable_3ds', false);
    }

    /**
     * @test getPaymentType function should return 'credit_card'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $creditCard = new CreditCard();
        $this->assertEquals('credit_card', $creditCard->getPaymentType());
    }

    /**
     * @test constructor can set token id, and has setter and getter for token id
     */
    public function it_provides_a_setter_and_getter_for_token_id()
    {
        $tokenId = '4811117d16c884-2cc7-4624-b0a8-10273b7f6cc8';
        $creditCard = new CreditCard($tokenId);

        $this->assertEquals($tokenId, $creditCard->getTokenId());

        $newTokenid = '441111-1118-28d2b436-f679-4f5d-8656-f652be7f5911';
        $creditCard->setTokenId($newTokenid);
        $this->assertEquals($newTokenid, $creditCard->getTokenId());
    }

    /**
     * @test 3ds can be set from config, constructor should enable 3ds according to config
     * enable3ds should change authentication to true,
     * and disable3ds should change authentication to false.
     */
    public function it_provides_a_setter_to_enable_3ds()
    {
        $tokenId = '4811117d16c884-2cc7-4624-b0a8-10273b7f6cc8';

        $creditCard = new CreditCard($tokenId);
        $this->assertArrayNotHasKey('authentication', $creditCard->getPaymentPayload());

        Config::set('midtrans.enable_3ds', true);
        $creditCard = new CreditCard($tokenId);
        $this->assertTrue($creditCard->getPaymentPayload()['authentication']);

        $creditCard->disable3ds();
        $this->assertArrayNotHasKey('authentication', $creditCard->getPaymentPayload());

        $creditCard->enable3ds();
        $this->assertTrue($creditCard->getPaymentPayload()['authentication']);
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
        $creditCard->saveTokenId();

        $this->assertTrue($creditCard->getSaveTokenId()); // default true

        $creditCard->dontSaveTokenId();
        $this->assertNotTrue($creditCard->getSaveTokenId());

        $creditCard->saveTokenId();
        $this->assertTrue($creditCard->getSaveTokenId());
    }

    /**
     * @test getPaymentPayload function should return credit card object.
     * https://api-docs.midtrans.com/?php#credit-card-object
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $tokenId = '4811117d16c884-2cc7-4624-b0a8-10273b7f6cc8';
        $creditCard = new CreditCard($tokenId);
        $creditCard->setBank('BNI');
        $creditCard->setInstallmentTerm(6);
        $creditCard->setBins(4811, 5233);
        $creditCard->setType('authorize');

        $this->assertEquals([
            'token_id' => $tokenId,
            'bank' => 'BNI',
            'installment_term' => 6,
            'bins' => [4811, 5233],
            'type' => 'authorize',
            'save_token_id' => true,
        ], $creditCard->getPaymentPayload());
    }
}
