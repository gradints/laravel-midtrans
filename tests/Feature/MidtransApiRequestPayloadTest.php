<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Midtrans;
use Gradints\LaravelMidtrans\Models\PaymentMethods\PermataBank;
use Gradints\LaravelMidtrans\Models\PaymentMethods\UOBEzPay;
use Tests\TestCase;

class MidtransApiRequestPayloadTest extends TestCase
{
    protected function setConfigCallback($app)
    {
        $app->config->set('midtrans.redirect.finish', 'https://example.com/payment-done');
    }

    /**
     * @test createSnapTransaction
     * @define-env setConfigCallback
     */
    public function it_provides_function_to_generate_request_payload_for_api()
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

        $expectedTransactionDetails = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
        ];
        $expectedCustomExpiry = [
            'custom_expiry' => [
                'expiry_duration' => 1,
                'unit' => 'day', // second, minute, hour, day],
            ],
        ];
        $expectedItems = [
            'item_details' => $items,
        ];
        $expectedCustomerDetails = [
            'customer_details' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'billing_address' => $billingAddress,
                'shipping_address' => $shippingAddress,
            ],
        ];

        $permata = new PermataBank();
        $requestPayload = $midtrans->generateRequestPayloadForApi($permata);
        $expected = array_merge(
            $expectedTransactionDetails,
            $expectedCustomExpiry,
            $expectedItems,
            $expectedCustomerDetails,
            ['payment_type' => $permata->getPaymentType(), $permata->getPaymentType() => $permata->getPaymentPayload()]
        );
        $this->assertEquals($expected, $requestPayload);

        $UOBEzPay = new UOBEzPay();
        $requestPayload = $midtrans->generateRequestPayloadForApi($UOBEzPay);
        $expected = array_merge(
            $expectedTransactionDetails,
            $expectedCustomExpiry,
            $expectedItems,
            $expectedCustomerDetails,
            ['payment_type' => $UOBEzPay->getPaymentType()]
        );
        $this->assertEquals($expected, $requestPayload);
    }
}
