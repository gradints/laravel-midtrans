<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Enums\TransactionStatus;
use Gradints\LaravelMidtrans\Midtrans;
use Gradints\LaravelMidtrans\MidtransGetTransactionStatus;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class MidtransGetTransactionStatusTest extends TestCase
{
    /**
     * @test getStatusFunction should return response from midtrans
     * @define-env
     */
    public function it_provides_getter_status_transaction_accept()
    {
        $mock = $this->mock('alias:App\Models\Purchase');
        $mock->shouldReceive('onPending')->once();

        $orderId = 'inv_1324_4159';
        $statusCode = '200';
        $grossAmount = '14500.00';
        $serverKey = Config::get('midtrans.server_key');
        $input = $orderId . $statusCode . $grossAmount . $serverKey;
        $signature = openssl_digest($input, 'sha512');

        $request = [
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
            ->with($orderId)
            ->andReturn($request);

        MidtransGetTransactionStatus::check($orderId);
    }

    /**
     * @test getAction should return ['App\Models\Purchase', 'onPending']
     */
    public function it_provides_a_get_action_pending()
    {
        $this->assertEquals(
            ['App\Models\Purchase', 'onPending'],
            MidtransGetTransactionStatus::getAction(TransactionStatus::PENDING->value)
        );
    }
}
