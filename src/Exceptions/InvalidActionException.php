<?php

namespace Gradints\LaravelMidtrans\Exceptions;

use Exception;

class InvalidActionException extends Exception
{
    protected $message = 'Action must be a string containing function name or an array with class name as first item and function name as second item.';
}
