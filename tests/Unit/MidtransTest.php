<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Midtrans;
use Gradints\LaravelMidtrans\Models\Customer;
use Gradints\LaravelMidtrans\Models\Refund;
use Gradints\LaravelMidtrans\Models\Transaction;
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
     * @test refund setter and getter
     */
    public function it_provides_a_setter_and_getter_for_refund()
    {
        $midtrans = new Midtrans();
        $this->assertNull($midtrans->getRefund());

        $refundKey = 'reference1';
        $amount = 1_000_000;
        $reason = 'Order cancel';
        $refund = new Refund($refundKey, $amount, $reason);

        $midtrans->setRefund($refundKey, $amount, $reason);
        $this->assertEquals($refund, $midtrans->getRefund());
    }
}
