<?php

namespace Tests\Unit;

use Tests\TestCase;

class MidtransRouteTest extends TestCase
{
    public function test_it_provides_routes_for_midtrans_notification()
    {
        $this->assertEquals('/midtrans/payment-notification', route('midtrans.payment-notification', [], false));
        $this->assertEquals('/midtrans/recurring-notification', route('midtrans.recurring-notification', [], false));
        $this->assertEquals('/midtrans/pay-account-notification', route('midtrans.pay-account-notification', [], false));
    }
}
