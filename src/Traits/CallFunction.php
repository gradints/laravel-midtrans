<?php

namespace Gradints\LaravelMidtrans\Traits;

trait CallFunction
{
    public static function callFunction(array $action, ...$parameters)
    {
        [$class, $function] = $action;

        $class::$function(...array_values($parameters));
    }
}