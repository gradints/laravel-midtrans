<?php

namespace Tests\Unit\PaymentMethods;

use Gradints\LaravelMidtrans\Models\PaymentMethods\KlikBCA;
use Tests\TestCase;

class KlikBCATest extends TestCase
{
    /**
     * @test getUserId
     */
    public function it_provides_a_getter_for_user_id()
    {
        $bca = new KlikBCA();
        $userId = 'GRADIN24';
        $bca->setUserId($userId);
        $this->assertEquals($userId, $bca->getUserId());
    }
    /**
     * @test getDescription
     */
    public function it_provides_a_getter_for_description()
    {
        $bca = new KlikBCA();
        $description = 'Purchase of a special event item';
        $bca->setDescription($description);
        $this->assertEquals($description, $bca->getDescription());
    }

    /**
     * @test getSnapName function should return 'bca_klikbca'.
     */
    public function it_provides_a_getter_for_snap_name()
    {
        $bca = new KlikBCA();
        $this->assertEquals('bca_klikbca', $bca->getSnapName());
    }

    /**
     * @test getApiPaymentType function should return 'bca_klikbca'.
     */
    public function it_provides_a_getter_for_api_payment_type()
    {
        $bca = new KlikBCA();
        $this->assertEquals('bca_klikbca', $bca->getApiPaymentType());
    }

    /**
     * @test getApiPaymentPayload function should return name of the bank.
     */
    public function it_provides_a_getter_for_api_payment_payload()
    {
        $bca = new KlikBCA();

        $userId = 'GRADIN24';
        $bca->setUserId($userId);

        $description = 'Purchase of a special event item';
        $bca->setDescription($description);

        $this->assertEquals([
            'user_id' => $userId,
            'description' => $description,
        ], $bca->getApiPaymentPayload());
    }
}
