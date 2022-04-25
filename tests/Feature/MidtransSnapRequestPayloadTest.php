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
    protected function setConfigPaymentMethodSnap($app)
    {
        $app->config->set('midtrans.enabled_payments', [
            'permata_va',
            'bri_va',
            'gopay',
        ]);
    }

    /**
     * @test createSnapTransaction
     * @define-env setConfigCallback
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
        $billingAddress = [
            'first_name' => 'TEST',
            'last_name' => 'UTOMO',
            'phone' => '081 2233 44-55',
            'address' => 'Sudirman',
            'city' => 'Jakarta',
            'postal_code' => '12190',
            'country_code' => 'IDN',
        ];
        $shippingAddress = [
            'first_name' => 'TEST',
            'last_name' => 'UTOMO',
            'phone' => '0 8128-75 7-9338',
            'address' => 'Sudirman',
            'city' => 'Jakarta',
            'postal_code' => '12190',
            'country_code' => 'IDN',
        ];

        $midtrans = new Midtrans();
        $midtrans->setTransaction($orderId, $grossAmount, $items);
        $midtrans->setCustomer("$firstName $lastName", $email);
        $midtrans->getCustomer()->setBillingAddress($billingAddress);
        $midtrans->getCustomer()->setShippingAddress($shippingAddress);

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
                'billing_address' => $billingAddress,
                'shipping_address' => $shippingAddress,
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
