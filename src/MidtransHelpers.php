<?php

namespace Gradints\LaravelMidtrans;

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
}
