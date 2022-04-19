<?php

namespace Tests\unit;

use Gradints\LaravelMidtrans\Models\Customer;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /** @test getter firstName */
    public function test_it_provides_a_getter_for_first_name()
    {
        $email = 'johndoe@example.com';
        $name = 'John';
        $customer = new Customer($name, $email);
        $this->assertEquals('John', $customer->getFirstName());

        $name = 'John Doe';
        $customer = new Customer($name, $email);
        $this->assertEquals('John', $customer->getFirstName());

        $name = 'John Max Doe';
        $customer = new Customer($name, $email);
        $this->assertEquals('John Max', $customer->getFirstName());

        $name = 'John Max Bob Doe';
        $customer = new Customer($name, $email);
        $this->assertEquals('John Max Bob', $customer->getFirstName());
    }

    /** @test getter lastName */
    public function test_it_provides_a_getter_for_last_name()
    {
        $email = 'johndoe@example.com';
        $name = 'John';
        $customer = new Customer($name, $email);
        $this->assertEquals('John', $customer->getLastName());

        $name = 'John Doe';
        $customer = new Customer($name, $email);
        $this->assertEquals('Doe', $customer->getLastName());

        $name = 'John Max Doe';
        $customer = new Customer($name, $email);
        $this->assertEquals('Doe', $customer->getLastName());

        $name = 'John Max Bob Doe';
        $customer = new Customer($name, $email);
        $this->assertEquals('Doe', $customer->getLastName());
    }

    /** @test getter email */
    public function test_it_provides_a_getter_for_email()
    {
        $email = 'johndoe@example.com';
        $name = 'John';
        $customer = new Customer($name, $email);

        $this->assertEquals($email, $customer->getEmail());
    }
}
