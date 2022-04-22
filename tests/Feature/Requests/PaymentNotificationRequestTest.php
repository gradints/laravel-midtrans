<?php

namespace Tests\Feature\Requests;

use Tests\TestCase;

class PaymentNotificationRequestTest extends TestCase
{
    protected function setServerKey($app)
    {
        $app->config->set('midtrans.server_key', 'askvnoibnosifnboseofinbofinfgbiufglnbfg');
    }

    /**
     * MidtranRequest should return error message when field is not provided or empty.
     */
    public function test_it_should_expect_request_body_to_content_signature_key()
    {
        $form = [];

        $url = route('midtrans.payment-notification');
        $this->postJson($url, $form)->assertJsonValidationErrors([
            'order_id' => 'The order id field is required.',
            'status_code' => 'The status code field is required.',
            'gross_amount' => 'The gross amount field is required.',
            'signature_key' => 'The signature key field is required.',
        ]);
    }

    /**
     * MidtransRequest should validate signature_key to make sure
     * the request comes from Midtrans itself.
     * @define-env setServerKey
     */
    public function test_it_validates_signature_in_payment_recurring_notification()
    {
        $url = route('midtrans.payment-notification');

        $orderId = '1111';
        $statusCode = '200';
        $grossAmount = '100000';

        $request = [
            'order_id' => $orderId,
            'status_code' => $statusCode,
            'gross_amount' => $grossAmount,
            'signature_key' => 'invalid_signature',
        ];

        $this->postJson($url, $request)->assertJsonValidationErrors([
            'signature_key' => 'signature is invalid.',
        ]);

        $serverKey = 'askvnoibnosifnboseofinbofinfgbiufglnbfg';
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $request['signature_key'] = openssl_digest($input, 'sha512');
        $this->postJson($url, $request)->assertJsonMissingValidationErrors('signature_key');
    }

    /**
     * MidtransRequest should validate signature_key to make sure
     * the request comes from Midtrans itself.
     * @define-env setServerKey
     */
    public function test_signature_key_should_fail_when_required_column_is_not_provided()
    {
        $url = route('midtrans.payment-notification');

        $serverKey = 'askvnoibnosifnboseofinbofinfgbiufglnbfg';
        $request = [
            'signature_key' => openssl_digest($serverKey, 'sha512'),
        ];

        $this->postJson($url, $request)->assertJsonValidationErrors([
            'signature_key' => 'signature is invalid.',
        ]);
    }
}
