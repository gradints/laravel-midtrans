<?php

namespace Tests\Unit;

use Exception;
use Gradints\LaravelMidtrans\Midtrans;
use Gradints\LaravelMidtrans\Models\Customer;
use Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank;
use Gradints\LaravelMidtrans\Models\Transaction;
use Midtrans\CoreApi;
use Tests\TestCase;

class MidtransTest extends TestCase
{
    protected function setConfigCallback($app)
    {
        $app->config->set('midtrans.redirect.finish', 'https://example.com/payment-done');
    }
    protected function setConfigPaymentMethodSnap($app)
    {
        $app->config->set('midtrans.enabled_payments', [
            'permata_va',
            'bri_va',
            'gopay',
        ]);
    }

    /**
     * @test config snap callback getter.
     * @define-env setConfigCallback
     */
    public function it_provides_a_getter_for_snap_callback()
    {
        $midtrans = new Midtrans();
        $this->assertEquals('https://example.com/payment-done', $midtrans->getCallbackUrl());
    }

    /**
     * @test config snap payment methods getter to be put
     * as enabled_payments in request payload.
     * @define-env setConfigPaymentMethodSnap
     */
    public function it_provides_a_getter_for_snap_enabled_payments()
    {
        $midtrans = new Midtrans();
        $expected = [
            'permata_va',
            'bri_va',
            'gopay',
        ];
        $this->assertEquals($expected, $midtrans->getSnapPaymentMethods());
    }

    /**
     * @test customer setter and getter
     */
    public function it_provides_a_setter_and_getter_for_transaction()
    {
        $midtrans = new Midtrans();
        $this->assertNull($midtrans->getTransaction());

        $orderId = 'TR-20220415-0001';
        $grossAmount = 20_000;
        $tansaction = new Transaction($orderId, $grossAmount);

        $midtrans->setTransaction($orderId, $grossAmount);
        $this->assertEquals($tansaction, $midtrans->getTransaction());
    }

    /**
     * @test customer setter and getter
     */
    public function it_provides_a_setter_and_getter_for_customer()
    {
        $midtrans = new Midtrans();
        $this->assertNull($midtrans->getCustomer());

        $name = 'John Doe';
        $email = 'johndoe@example.com';
        $customer = new Customer($name, $email);

        $midtrans->setCustomer($name, $email);
        $this->assertEquals($customer, $midtrans->getCustomer());
    }

    /**
     * @test createApiTransaction
     */
    public function it_wraps_core_api_with_try_catch_and_return_translated_error_message()
    {
        $mock = $this->mock('alias:' . CoreApi::class);
        $mock->shouldReceive('charge')->andThrow(
            Exception::class,
            '',
            400
        );

        $method = new PermataBank();
        $midtrans = new Midtrans();
        $midtrans->setTransaction('TR-001', 20_000);
        $midtrans->setCustomer('Name', 'email@example.test');

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $this->expectExceptionMessage(__('Invalid payment info.'));

        $midtrans->createApiTransaction($method);
    }
}
