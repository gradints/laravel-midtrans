<?php

namespace Tests\Unit;

use Gradints\LaravelMidtrans\Exceptions\InvalidActionException;
use Gradints\LaravelMidtrans\MidtransHelpers;
use Tests\TestCase;

class CallFunctionTest extends TestCase
{
    public function test_it_calls_static_function_given_array_of_class_and_function_name()
    {
        $this->mock('alias:Package\ClassName', function ($mock) {
            $mock->shouldReceive('methodName')->withArgs(['args1', 'args2'])->once();
        });

        MidtransHelpers::callFunction(['Package\ClassName', 'methodName'], 'args1', 'args2');
    }

    public function test_it_calls_global_function_given_string_as_action()
    {
        $strpad = MidtransHelpers::callFunction('str_pad', '1', 4, '0', STR_PAD_LEFT);
        $this->assertEquals('0001', $strpad);
    }

    public function test_it_should_throw_invalid_action_exception_if_action_is_empty_string()
    {
        $this->expectException(InvalidActionException::class);
        MidtransHelpers::callFunction('', 'args1');
    }

    public function test_it_should_throw_invalid_action_exception_if_action_is_not_a_valid_array()
    {
        $this->expectException(InvalidActionException::class);
        MidtransHelpers::callFunction([1, 'name'], 'args1');
    }
}
