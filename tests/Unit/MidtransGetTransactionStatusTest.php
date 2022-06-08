<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Enums\TransactionStatus;
use Gradints\LaravelMidtrans\Midtrans;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class MidtransGetTransactionStatusTest extends TestCase
{
    public function test_it_provides_getter_status_transaction_and_return_response_from_midtrans()
    {
        $orderId = 'inv_1324_4159';
        $statusCode = '200';
        $grossAmount = '14500.00';
        $serverKey = config('midtrans.server_key');
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $signature = openssl_digest($input, 'sha512');

        $response = [
            'transaction_time' => now()->subMinutes(1)->toJSON(),
            'transaction_status' => 'pending',
            'transaction_id' => '513f1f01-c9da-474c-9fc9-d5c64364b709',
            'status_message' => 'midtrans payment notification',
            'status_code' => $statusCode,
            'signature_key' => $signature,
            'settlement_time' => now()->toJSON(),
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

        $transactionMock = $this->mock('alias:' . \Midtrans\Transaction::class);
        $transactionMock->shouldReceive('status')
            ->once()
            ->withArgs([$orderId])
            ->andReturn($response);

        $mock = $this->mock('alias:' . config('midtrans.payment_notification.pending')[0]);
        $mock->shouldReceive('onPending')->withArgs([$response])->once();

        $midtransResponse = Midtrans::getTransactionStatus($orderId);

        $this->assertEquals((object) $response, (object) $midtransResponse);
    }

    public function test_it_doesnt_error_if_payment_notification_config_is_empty()
    {
        $request = [
            'transaction_status' => 'pending',
        ];

        $orderId = 'TR-0001';

        $transactionMock = $this->mock('alias:' . \Midtrans\Transaction::class);
        $transactionMock->shouldReceive('status')
            ->once()
            ->withArgs([$orderId])
            ->andReturn($request);

        Config::set('midtrans.payment_notification.pending', []);

        $this->assertEquals([], TransactionStatus::from('pending')->getAction());

        Midtrans::getTransactionStatus($orderId);
    }
}
