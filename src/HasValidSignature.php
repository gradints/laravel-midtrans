<?php

namespace Gradints\LaravelMidtrans;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;

class HasValidSignature implements Rule
{
    PUBLIC CONST TRANSACTION_NOTIFICATION = 'Transaction notification';
    PUBLIC CONST PAY_ACCOUNT_NOTIFICATION = 'Pay Account notification';
    

    public function __construct(
        private string $typeNotification = self::TRANSACTION_NOTIFICATION
    ) {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->typeNotification === self::TRANSACTION_NOTIFICATION) {
            return $this->typeTransactionNotification($value);
        } 
        
        // return $this->typePayAccountNotification($value);
    }

    private function typeTransactionNotification($value)
    {
        $orderId = request()->get('order_id');
        $statusCode = request()->get('status_code');
        $grossAmount = request()->get('gross_amount');

        $serverKey = Config::get('midtrans.server_key');
        $signature = openssl_digest($orderId . $statusCode . $grossAmount . $serverKey, 'sha512');

        return $signature === $value;
    }

    private function typePayAccountNotification($value)
    {
        // TODO ADD TESTING FIRST
        // $accountId = request()->get('account_id');
        // $accountStatus = request()->get('account_status');
        // $statusCode = request()->get('status_code');

        // $serverKey = Config::get('midtrans.server_key');
        // $signature = openssl_digest($accountId . $accountStatus . $statusCode . $serverKey, 'sha512');

        // return $signature === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('signature is invalid.');
    }
}
