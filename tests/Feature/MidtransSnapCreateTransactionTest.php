<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Midtrans\Snap as MidtransSnap;
use Mockery\MockInterface;
use Tests\TestCase;

class MidtransSnapCreateTransactionTest extends TestCase
{
    protected function setConfigCallback($app)
    {
        $app->config->set('midtrans.redirect.finish', 'https://example.com/payment-done');
    }

    /**
     * @test
     * @define-env setConfigCallback
     */
    public function it_calls_midtrans_snap_create_transaction_with_snap_payload()
    {
        $randomToken = '66e4fa55-fdac-4ef9-91b5-733b97d1b862';
        $redirectUrl = 'https://app.sandbox.midtrans.com/snap/v2/vtweb/66e4fa55-fdac-4ef9-91b5-733b97d1b86';
        $this->mock(
            'alias:' . MidtransSnap::class,
            function (MockInterface $mock) use ($randomToken, $redirectUrl) {
                $mock->shouldReceive('createTransaction')
                    ->once()
                    ->andReturn((object)[
                        'token' => $randomToken,
                        'redirect_url' => $redirectUrl,
                    ]);
            }
        );

        $customerName = 'John Doe';
        $customerEmail = 'johnDoe@example.test';

        $orderId = 'TR-20200415-00001';
        $grossAmount = 20_000;

        $midtrans = new Midtrans();
        $midtrans->setTransaction($orderId, $grossAmount);
        $midtrans->setCustomer($customerName, $customerEmail);

        $this->assertEquals(
            (object)['token' => $randomToken, 'redirect_url' => $redirectUrl],
            $midtrans->createSnapTransaction(),
        );
    }
}
