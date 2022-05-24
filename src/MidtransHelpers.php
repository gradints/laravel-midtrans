<?php

namespace Gradints\LaravelMidtrans;

use Exception;
use Gradints\LaravelMidtrans\Exceptions\InvalidActionException;

class MidtransHelpers
{
    /**
     * callFunction(['Folder\ClassName', 'methodName'], $args1, $args2)
     * Will execute Folder\ClassName::methodName($args1, $args2)
     *
     * callFunction('implode', ',', [1,2,3])
     * Will execute implode(',', [1,2,3])
     *
     * @param  string[]|string  $action
     * @param  mixed ...$parameters
     * @return mixed
     */
    public static function callFunction(array|string $action, ...$parameters)
    {
        if (empty($action)) {
            throw new InvalidActionException();
            return;
        }

        if (is_string($action)) {
            return $action(...array_values($parameters));
        }

        if (!is_array($action)) {
            throw new InvalidActionException();
        }

        if (count($action) < 2) {
            throw new InvalidActionException();
        }

        if (!is_string($action[0]) || !is_string($action[1])) {
            throw new InvalidActionException();
        }

        [$class, $function] = $action;
        return $class::$function(...array_values($parameters));
    }

    /**
     * Catch Midtrans exception and convert them to readable error.
     *
     * @param  Callable  $callback
     * @return mixed
     */
    public static function tryCatch(callable $callback)
    {
        try {
            return $callback();
        } catch (Exception $ex) {
            // https://api-docs.midtrans.com/?php#code-4xx
            $message = self::getErrorMessage($ex->getCode());
            if (empty($message)) {
                $message = __('Unknown error.') . ' ' . $ex->getMessage();
            }
            throw \Illuminate\Validation\ValidationException::withMessages([
                'payments' => [$message, $ex->getMessage()],
            ]);
        }
    }

    /**
     * Translate Midtrans error code to a readable error message.
     *
     * @param  int  $code
     * @return string
     */
    private static function getErrorMessage(int $code): string
    {
        switch ($code) {
            case 400: return __('Invalid payment info.');
            case 401: return __('Access denied. Please check Client Key or Server Key.');
            case 402: return __('Payment channel is not activated.');
            case 403: return __('The requested resource is not capable of generating content in the format specified in the request headers.');
            case 404: return __('The requested resource/transaction is not found. Please check order_id or other details sent in the request.');
            case 405: return __('HTTP method is not allowed.');
            case 406: return __('Duplicate order ID.');
            case 407: return __('Transaction expired.');
            case 408: return __('Wrong data type.');
            case 409: return __('You have sent too many transactions for the same card number.');
            case 410: return __('Your account is deactivated. Please contact Midtrans support.');
            case 411: return __('token_id is missing, invalid, or timed out.');
            case 412: return __('You cannot modify status of the transaction.');
            case 413: return __('The request cannot be processed due to syntax error in the request body.');
            case 414: return __('Refund request is rejected due to merchant insufficient funds.');
            case 429: return __('API rate limit exceeded.');
            case 500: return __('Internal Server Error.');
            case 501: return __('The feature is not available.');
            case 502: return __('Internal Server Error: Bank Connection Problem.');
            case 503: return __('Bank/partner is experiencing connection issue.');
            case 504: return __('Internal Server Error: Midtrans Fraud Detection System is unavailable.');
            case 505: return __('Failure to create requested VA number. Try again later.');
            default: return '';
        }
    }
}
