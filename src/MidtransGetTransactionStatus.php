<?php

namespace Gradints\LaravelMidtrans;

use Gradints\LaravelMidtrans\Enums\TransactionStatus;
use Gradints\LaravelMidtrans\Traits\CallFunction;

class MidtransGetTransactionStatus
{
    use CallFunction;

    // TODO check current status every 5 minutes in case notification does not arrive.
    // TODO check fraud status,

    // TODO Ignore delayed/unordered status notifications, refer to column Possible change(s)
    // in https://api-docs.midtrans.com/?php#transaction-status

    public static function check(string $orderId)
    {
        $response =  (object)\Midtrans\Transaction::status($orderId);

        // TODO throw InvalidRequestException

        $externalFunction = self::getAction(
            $response->transaction_status,
            $response->fraud_status
        );

        self::callFunction($externalFunction, $response);
    }

    public static function getAction($transactionStatus, $fraudStatus = null)
    {
        return TransactionStatus::from($transactionStatus)->getAction();
    }
}
