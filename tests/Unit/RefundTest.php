<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Models\PaymentMethods\CreditCard;
use Gradints\LaravelMidtrans\Models\PaymentMethods\Gopay;
use Gradints\LaravelMidtrans\Models\PaymentMethods\MandiriBank;
use Gradints\LaravelMidtrans\Models\PaymentMethods\Qris;
use Gradints\LaravelMidtrans\Models\PaymentMethods\ShopeePay;
use Gradints\LaravelMidtrans\Models\Refund;
use Tests\TestCase;

class RefundTest extends TestCase
{
    public function test_a_setter_and_getter_for_payment_method()
    {
        $creditCard = new CreditCard();

        $refund = new Refund();
        $refund->setPaymentMethod($creditCard);

        $this->assertEquals($creditCard, $refund->getPaymentMethod());
    }

    public function test_a_setter_and_getter_for_refund_key()
    {
        $refundKey = 'reference1';

        $refund = new Refund();
        $refund->setRefundKey($refundKey);

        $this->assertEquals($refundKey, $refund->getRefundKey());
    }

    public function test_a_setter_and_getter_for_amount()
    {
        $amount = 1_000_000;

        $refund = new Refund();
        $refund->setAmount($amount);

        $this->assertEquals($amount, $refund->getAmount());
    }

    public function test_a_setter_and_getter_for_reason()
    {
        $reason = 'Cancel order';

        $refund = new Refund();
        $refund->setReason($reason);

        $this->assertEquals($reason, $refund->getReason());
    }

    public function test_a_setter_and_getter_for_bank()
    {
        $bank = 'bca';

        $refund = new Refund();
        $refund->setBank($bank);

        $this->assertEquals($bank, $refund->getBank());
    }

    public function test_a_function_generate_payload()
    {
        $creditCard = new CreditCard();
        $refundKey = 'reference1';
        $amount = 100_000;
        $reason = 'Order cancel';

        $refund = new Refund($creditCard, $refundKey, $amount, $reason);
        $this->assertEquals([
            'refund_key' => $refundKey,
            'amount' => $amount,
            'reason' => $reason,
        ], $refund->generatePayload());
    }

    public function test_a_function_is_support_refund()
    {
        $creditCard = new CreditCard();

        $refund = new Refund();
        $refund->setPaymentMethod($creditCard);

        $refund->setBank('bni');
        $this->assertTrue($refund->isSupportRefund());

        $refund->setBank('mandiri');
        $this->assertTrue($refund->isSupportRefund());

        $refund->setBank('cimb');
        $this->assertTrue($refund->isSupportRefund());

        // not supported
        $refund->setBank('bca');
        $this->assertFalse($refund->isSupportRefund());

        $gopay = new Gopay();
        $refund->setPaymentMethod($gopay);
        $this->assertFalse($refund->isSupportRefund());
    }

    public function test_a_function_is_support_refund_direct()
    {
        $creditCard = new CreditCard();

        $refund = new Refund();
        $refund->setPaymentMethod($creditCard);

        $refund->setBank('bca');
        $this->assertTrue($refund->isSupportRefundDirect());

        $refund->setBank('maybank');
        $this->assertTrue($refund->isSupportRefundDirect());

        $refund->setBank('bri');
        $this->assertTrue($refund->isSupportRefundDirect());

        // different bank
        $refund->setBank('bni');
        $this->assertFalse($refund->isSupportRefundDirect());

        $gopay = new Gopay();
        $refund->setPaymentMethod($gopay);
        $this->assertTrue($refund->isSupportRefundDirect());

        $shopeePay = new ShopeePay();
        $refund->setPaymentMethod($shopeePay);
        $this->assertTrue($refund->isSupportRefundDirect());

        $qris = new Qris();
        $refund->setPaymentMethod($qris);
        $this->assertTrue($refund->isSupportRefundDirect());

        // not supported
        $mandiri = new MandiriBank();
        $refund->setPaymentMethod($mandiri);
        $this->assertFalse($refund->isSupportRefundDirect());
    }
}
