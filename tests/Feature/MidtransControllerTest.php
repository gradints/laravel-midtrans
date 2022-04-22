<?php

namespace Tests\Feature;

use Gradints\LaravelMidtrans\Validations\Requests\PaymentNotificationRequest;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class MidtransControllerTest extends TestCase
{
    protected function setConfigServerKey($app)
    {
        $app->config->set('midtrans.server_key', 'askvnoibnosifnboseofinbofinfgbiufglnbfg');
    }
    protected function setConfigCallback($app)
    {
        $app->config->set('midtrans.payment_notification.pending', [
            'App\Models\Purchase',
            'updatePaymentStatusPending',
        ]);
        $app->config->set('midtrans.recurring_notification', [
            'Gradints\LaravelMidtrans\Models\UserClass',
            'updateMembershipStatus',
        ]);
    }

    /**
     * @test
     * @define-env setConfigCallback
     * @define-env setConfigServerKey
     */
    public function it_provides_routes_to_receive_payment_notification_from_midtrans_status_pending()
    {
        $request = [
            'transaction_status' => 'pending',
            'fraud_status' => 'accept',
        ];
        $this->partialMock(PaymentNotificationRequest::class, function ($mock) use ($request) {
            $mock->shouldAllowMockingProtectedMethods();
            $mock->shouldReceive('retrieveItem')->withArgs(['transaction_status'])->andReturn('pending');
            $mock->shouldReceive('retrieveItem')->withArgs(['fraud_status'])->andReturn('accept');
            $mock->shouldReceive('retrieveItem')->withAnyArgs()->andReturn('');
            $mock->shouldReceive('getRealMethod')->withAnyArgs()->andReturn('');
            $mock->shouldReceive('all')->withAnyArgs()->andReturn($request);
        });

        $this->mock('alias:App\Models\Purchase', function ($mock) {
            $mock->shouldReceive('updatePaymentStatusPending')->once();
        });

        $url = route('midtrans.payment-notification');
        $this->postJson($url, [])->assertOk();
    }

    /**
     * @test
     * @define-env setConfigCallback
     * @define-env setConfigServerKey
     */
    public function it_provides_routes_to_receive_recurring_notification_from_midtrans()
    {
        $mock = $this->mock('alias:Gradints\LaravelMidtrans\Models\UserClass');
        $mock->shouldReceive('updateMembershipStatus');

        $orderId = '1111';
        $statusCode = '200';
        $grossAmount = '100000';
        $serverKey = 'askvnoibnosifnboseofinbofinfgbiufglnbfg';
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $signature = openssl_digest($input, 'sha512');

        $request = [
            'transaction_time' => now()->subMinutes(1),
            'transaction_status' => 'capture',
            'transaction_id' => '513f1f01-c9da-474c-9fc9-d5c64364b709',
            'status_message' => 'midtrans payment notification',
            'status_code' => $statusCode,
            'signature_key' => $signature,
            'settlement_time' => now(),
            'payment_type' => 'credit_card',
            'order_id' => $orderId,
            'merchant_id' => 'G141532850',
            'masked_card' => '4811111 1114',
            'gross_amount' => $grossAmount,
            'fraud_status' => 'accept',
            'eci' => '05',
            'currency' => 'IDR',
            'channel_response_message' => 'Approved',
            'channel_response_code' => '00',
            'card_type' => 'credit',
            'bank' => 'bni',
            'approval_code' => '1578569243927',
        ];

        // $url = Config::get('midtrans.endpoints.recurring_notification');
        $url = '/midtrans/recurring-notification';
        $this->postJson($url, $request)->assertOk();
    }
}
