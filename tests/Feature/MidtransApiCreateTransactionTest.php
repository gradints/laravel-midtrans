<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank;
use Midtrans\CoreApi as MidtransApi;
use Mockery\MockInterface;
use Tests\TestCase;

class MidtransApiCreateTransactionTest extends TestCase
{
    /**
    * @test
    */
    public function it_calls_midtrans_api_create_transaction_with_api_payload_permata()
    {
        $response = [
            'status_code' => '201',
            // 'transaction_status' => 'pending',
            // 'fraud_status' => 'accept',
            // 'permata_va_number' => '8562000087926752',
        ];

        $this->mock(
            'alias:' . MidtransApi::class,
            function (MockInterface $mock) use ($response) {
                $mock->shouldReceive('charge')
                    ->once()
                    ->andReturn((object)$response);
            }
        );

        $midtrans = new Midtrans();

        $orderId = 'TR/20220415/00001';
        $grossAmount = 20_000;

        $customerName = 'John Doe';
        $customerEmail = 'johndoe@example.com';

        $midtrans->setTransaction($orderId, $grossAmount);
        $midtrans->setCustomer($customerName, $customerEmail);

        $permata = new PermataBank();

        $this->assertEquals(
            (object) ['status_code' => '201'],
            $midtrans->createApiTransaction($permata)
        );
    }
}
