<?php

namespace Tests\unit;

use Gradints\LaravelMidtrans\Models\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * Test get firstName
     *
     * @return void
     */
    public function testGetFirstName()
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

    /**
     * Test get lastName
     *
     * @return void
     */
    public function testGetLastName()
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

    /**
     * Test get email
     *
     * @return void
     */
    public function testGetEmail()
    {
        $email = 'johndoe@example.com';
        $name = 'John';
        $customer = new Customer($name, $email);

        $this->assertEquals($email, $customer->getEmail());
    }
}
