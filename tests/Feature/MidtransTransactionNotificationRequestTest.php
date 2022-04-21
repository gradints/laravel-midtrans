<?php

namespace Tests\Feature;

use Tests\TestCase;

class MidtransTransactionNotificationRequestTest extends TestCase
{
    protected function setServerKey($app)
    {
        $app->config->set('midtrans.server_key', 'askvnoibnosifnboseofinbofinfgbiufglnbfg');
    }

    /**
     * @test MidtranRequest should return error message when field is not provided or empty.
     */
    public function testRequired()
    {
        $form = [];
    
        $url ='midtrans/payment-notification';
        $this->postJson($url, $form)->assertJsonValidationErrors([
            'signature_key' => 'The signature key field is required.',
        ]);
    }

    /**
     * @test MidtransRequest should validate signature
     * @define-env setServerKey
     */
    public function it_validates_signature_to_make_sure_the_request_comes_from_midtrans()
    {
        $url ='midtrans/payment-notification';

        $orderId = '1111';
        $statusCode = '200';
        $grossAmount = '100000';
        $serverKey = 'random_key_sdasjcqjbrq';
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $signature = openssl_digest($input, 'sha512');

        $request = [
            'order_id' => $orderId,
            'status_code' => $statusCode,
            'gross_amount' => $grossAmount,
            'signature_key' => $signature,
        ];

        $this->postJson($url, $request)->assertJsonValidationErrors([
            'signature_key' => 'signature is invalid.',
        ]);

        $serverKey = 'askvnoibnosifnboseofinbofinfgbiufglnbfg';
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $request['signature_key'] = openssl_digest($input, 'sha512');
        $this->postJson($url, $request)->assertJsonMissingValidationErrors('signature_key');
    }
}
