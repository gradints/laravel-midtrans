<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Enums\TransactionStatus;
use Gradints\LaravelMidtrans\Validations\Requests\PaymentNotificationRequest;
use Tests\TestCase;

class MidtransControllerPaymentNotificationTest extends TestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app)
    {
        $app->config->set('midtrans.payment_notification', [
            'pending' => ['App\Models\MyModel', 'actionOnPending'],
            'capture' => ['App\Models\MyModel', 'actionOnCapture'],
            'settlement' => ['App\Models\MyModel', 'actionOnSettlement'],
            'cancel' => ['App\Models\MyModel', 'actionOnCancel'],
            'deny' => ['App\Models\MyModel', 'actionOnDeny'],
            'expire' => ['App\Models\MyModel', 'actionOnExpire'],
            'failure' => ['App\Models\MyModel', 'actionOnFailure'],
            'authorize' => ['App\Models\MyModel', 'actionOnAuthorize'],
            'refund' => ['App\Models\MyModel', 'actionOnRefund'],
            'partial_refund' => ['App\Models\MyModel', 'actionOnPartialRefund'],
            'chargeback' => ['App\Models\MyModel', 'actionOnChargeback'],
            'partial_chargeback' => ['App\Models\MyModel', 'actionOnPartialChargeback'],
        ]);
    }

    private function assertActionIsCalled(string $action, TransactionStatus $status): void
    {
        $request = [
            'transaction_status' => $status->value,
        ];

        $this->partialMock(PaymentNotificationRequest::class, function ($mock) use ($request) {
            $mock->shouldReceive('all')->withAnyArgs()->andReturn($request);
        });

        $this->mock('alias:App\Models\MyModel', function ($mock) use ($action) {
            $mock->shouldReceive($action)->once();
        });

        $url = route('midtrans.payment-notification');
        $this->postJson($url)->assertOk();
    }

    public function test_it_should_calls_onpending_when_transaction_status_is_pending()
    {
        $this->assertActionIsCalled('actionOnPending', TransactionStatus::PENDING);
    }

    public function test_it_should_calls_oncapture_when_transaction_status_is_capture()
    {
        $this->assertActionIsCalled('actionOnCapture', TransactionStatus::CAPTURE);
    }

    public function test_it_should_calls_onsettlement_when_transaction_status_is_settlement()
    {
        $this->assertActionIsCalled('actionOnSettlement', TransactionStatus::SETTLEMENT);
    }

    public function test_it_should_calls_oncancel_when_transaction_status_is_cancel()
    {
        $this->assertActionIsCalled('actionOnCancel', TransactionStatus::CANCEL);
    }

    public function test_it_should_calls_ondeny_when_transaction_status_is_deny()
    {
        $this->assertActionIsCalled('actionOnDeny', TransactionStatus::DENY);
    }

    public function test_it_should_calls_onexpire_when_transaction_status_is_expire()
    {
        $this->assertActionIsCalled('actionOnExpire', TransactionStatus::EXPIRE);
    }

    public function test_it_should_calls_onfailure_when_transaction_status_is_failure()
    {
        $this->assertActionIsCalled('actionOnFailure', TransactionStatus::FAILURE);
    }

    public function test_it_should_calls_onauthorize_when_transaction_status_is_authorize()
    {
        $this->assertActionIsCalled('actionOnAuthorize', TransactionStatus::AUTHORIZE);
    }

    public function test_it_should_calls_onrefund_when_transaction_status_is_refund()
    {
        $this->assertActionIsCalled('actionOnRefund', TransactionStatus::REFUND);
    }

    public function test_it_should_calls_onpartialrefund_when_transaction_status_is_partial_refund()
    {
        $this->assertActionIsCalled('actionOnPartialRefund', TransactionStatus::PARTIAL_REFUND);
    }

    public function test_it_should_calls_onchargeback_when_transaction_status_is_chargeback()
    {
        $this->assertActionIsCalled('actionOnChargeback', TransactionStatus::CHARGEBACK);
    }

    public function test_it_should_calls_onpartialchargeback_when_transaction_status_is_partial_chargeback()
    {
        $this->assertActionIsCalled('actionOnPartialChargeback', TransactionStatus::PARTIAL_CHARGEBACK);
    }
}
