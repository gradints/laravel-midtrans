<?php

namespace Gradints\LaravelMidtrans\Exceptions;

use Exception;

class InvalidOrderIdFormatException extends Exception
{
    protected $message = 'Order id maximum length is 50 characters and can only contains alphanumeric , dash(-), underscore(_), tilde (~), and dot (.).';
}
