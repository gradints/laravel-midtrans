<?php

namespace Gradints\LaravelMidtrans\Validations\Rules;

use Illuminate\Contracts\Validation\Rule;

class HasValidSignature implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $orderId = request()->get('order_id') ?? 'empty';
        $statusCode = request()->get('status_code') ?? 'empty';
        $grossAmount = request()->get('gross_amount') ?? 'empty';

        $serverKey = config('midtrans.server_key');
        $signature = openssl_digest($orderId . $statusCode . $grossAmount . $serverKey, 'sha512');

        // payment / recurring notification
        if ($signature === $value) {
            return true;
        }

        // pay account notification
        $accountId = request()->get('account_id') ?? 'empty';
        $accountStatus = request()->get('account_status') ?? 'empty';
        $signature = openssl_digest($accountId . $accountStatus . $statusCode . $serverKey, 'sha512');

        return $signature === $value;
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
