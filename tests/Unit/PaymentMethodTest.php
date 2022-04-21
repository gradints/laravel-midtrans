<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank;

use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    protected function usesSnap($app)
    {
        $app->config->set('midtrans.payment_methods.snap', [
            PermataBank::class,
        ]);
    }

    /**
     * @test isUsingSnap getter function should return false.
     */
    public function it_provides_a_getter_for_is_using_snap_false()
    {
        $permata = new PermataBank();
        $this->assertEquals(false, $permata->isUsingSnap());
    }

    /**
     * @test isUsingSnap getter function should return true.
     * @define-env usesSnap
     */
    public function it_provides_a_getter_for_is_using_snap_true()
    {
        $permata = new PermataBank();
        $this->assertEquals(true, $permata->isUsingSnap());
    }

    protected function usesApi($app)
    {
        $app->config->set('midtrans.payment_methods.api', [
            PermataBank::class,
        ]);
    }

    /**
     * @test isUsingApi getter function should return false.
     */
    public function it_provides_a_getter_for_is_using_api_false()
    {
        $permata = new PermataBank();
        $this->assertEquals(false, $permata->isUsingApi());
    }

    /**
     * @test isUsingApi getter function should return true.
     * @define-env usesApi
     */
    public function it_provides_a_getter_for_is_using_api_true()
    {
        $permata = new PermataBank();
        $this->assertEquals(true, $permata->isUsingApi());
    }
}
