<?php

namespace Tests\Feature\Requests;

use Tests\TestCase;

class PayAccountNotificationRequestTest extends TestCase
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
        $url = route('midtrans.pay-account-notification');

        $form = [];
        $this->postJson($url, $form)->assertJsonValidationErrors([
            'account_id' => 'The account id field is required.',
            'account_status' => 'The account status field is required.',
            'status_code' => 'The status code field is required.',
            'signature_key' => 'The signature key field is required.',
        ]);
    }

    /**
     * MidtransRequest should validate signature_key to make sure
     * the request comes from Midtrans itself.
     * @define-env setServerKey
     */
    public function test_it_validates_signature_in_pay_account_notification()
    {
        $url = route('midtrans.pay-account-notification');

        $accountId = '1111';
        $accountStatus = 'active';
        $statusCode = '200';

        $request = [
            'account_id' => $accountId,
            'status_code' => $statusCode,
            'account_status' => $accountStatus,
            'signature_key' => 'invalid_signature',
        ];

        $this->postJson($url, $request)->assertJsonValidationErrors([
            'signature_key' => 'signature is invalid.',
        ]);

        $serverKey = 'askvnoibnosifnboseofinbofinfgbiufglnbfg';
        $input = $accountId . $accountStatus . $statusCode . $serverKey;
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
        $url = route('midtrans.pay-account-notification');

        $serverKey = 'askvnoibnosifnboseofinbofinfgbiufglnbfg';
        $request = [
            'signature_key' => openssl_digest($serverKey, 'sha512'),
        ];

        $this->postJson($url, $request)->assertJsonValidationErrors([
            'signature_key' => 'signature is invalid.',
        ]);
    }
}
