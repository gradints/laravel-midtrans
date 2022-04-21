<?php

namespace Tests\Unit;

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

    /** @test getter phone */
    public function test_it_provides_a_getter_for_phone()
    {
        $email = 'johndoe@example.com';
        $name = 'John';
        $phone = '+6281234567890';
        $customer = new Customer($name, $email, $phone);

        $this->assertEquals($phone, $customer->getPhone());
    }

    /** @test setter and getter billing_address */
    public function test_it_provides_a_setter_and_getter_for_billing_address()
    {
        $email = 'johndoe@example.com';
        $name = 'John';
        $customer = new Customer($name, $email);

        $billingAddress = [
            'first_name' => 'TEST',
            'last_name' => 'UTOMO',
            'phone' => '081 2233 44-55',
            'address' => 'Sudirman',
            'city' => 'Jakarta',
            'postal_code' => '12190',
            'country_code' => 'IDN',
        ];
        $customer->setBillingAddress($billingAddress);

        $this->assertEquals($billingAddress, $customer->getBillingAddress());
    }

    /** @test setter and getter shipping_address */
    public function test_it_provides_a_setter_and_getter_for_shipping_address()
    {
        $email = 'johndoe@example.com';
        $name = 'John';
        $customer = new Customer($name, $email);

        $shippingAddress = [
            'first_name' => 'TEST',
            'last_name' => 'UTOMO',
            'phone' => '081 2233 44-55',
            'address' => 'Sudirman',
            'city' => 'Jakarta',
            'postal_code' => '12190',
            'country_code' => 'IDN',
        ];
        $customer->setShippingAddress($shippingAddress);

        $this->assertEquals($shippingAddress, $customer->getShippingAddress());
    }
}
