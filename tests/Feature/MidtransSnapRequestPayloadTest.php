<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Tests\TestCase;

class MidtransSnapRequestPayloadTest extends TestCase
{
    protected function setConfigCallback($app)
    {
        $app->config->set('midtrans.redirect.finish', 'https://example.com/payment-done');
    }
    protected function setConfigExpiry($app)
    {
        $app->config->set('midtrans.expiry.duration', 1);
        $app->config->set('midtrans.expiry.duration_unit', 'day');
    }
    protected function setConfigPaymentMethodSnap($app)
    {
        $app->config->set('midtrans.payment_methods.snap', [
            \Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank::class,
            \Gradints\LaravelMidtrans\Models\PaymentMethods\BRIBank::class,
            \Gradints\LaravelMidtrans\Models\PaymentMethods\Gopay::class,
        ]);
    }

    /**
     * @test createSnapTransaction
     * @define-env setConfigCallback
     * @define-env setConfigExpiry
     * @define-env setConfigPaymentMethodSnap
     */
    public function it_provides_function_to_generate_request_payload_for_snap()
    {
        $orderId = 'inv_19042022_01';
        $grossAmount = 20_000;
        $items = [
            [
                'id' => '1',
                'price' => 100_000,
                'name' => 'Pulsa Indosat Rp 100,000',
            ],
            [
                'id' => '2',
                'price' => 3_000,
                'name' => 'Indomie Goreng',
            ],
        ];

        $firstName = 'John';
        $lastName = 'Doe';
        $email = 'johndoe@example.com';

        $midtrans = new Midtrans();
        $midtrans->setTransaction($orderId, $grossAmount, $items);
        $midtrans->setCustomer("$firstName $lastName", $email);

        $requestPayload = $midtrans->generateRequestPayloadForSnap();
        $expected = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => $items,
            'customer_details' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
            ],
            'expiry' => [
                'duration' => 1,
                'init' => 'day', // second, minute, hour, day],
            ],
            'enabled_payments' => [
                'permata_va',
                'bri_va',
                'gopay',
            ],
            'callbacks' => [
                'finish' => 'https://example.com/payment-done',
            ],
        ];
        $this->assertEquals($expected, $requestPayload);
    }
}
