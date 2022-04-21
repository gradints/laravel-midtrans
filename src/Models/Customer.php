<?php

namespace Gradints\LaravelMidtrans\Models;

class Customer
{
    private array $billingAddress = [];

    public function __construct(
        private string $name,
        private string $email,
        private string $phone = '',
    ) {
    }

    /**
     * Get user's firstname by omitting the last word in their fullname.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        $words = explode(' ', $this->name);

        // if more than 1 words, remove the last word.
        if (count($words) > 1) {
            array_pop($words);
        }

        return implode(' ', $words);
    }

    /**
     * Get user's firstname by only get the last word in their fullname.
     *
     * @return string
     */
    public function getLastName(): string
    {
        $words = explode(' ', $this->name);

        return end($words);
    }

    /**
     * Get user's email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get user's phone.
     *
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set user's billing_address
     * @set $billingAddress
     */
    public function setBillingAddress(array $billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * Set user's billing_address
     */
    public function getBillingAddress(): array
    {
        return $this->billingAddress;
    }

    /**
     * Set user's shipping_address
     * @set $billingAddress
     */
    public function setShippingAddress(array $shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * Set user's shipping_address
     */
    public function getShippingAddress(): array
    {
        return $this->shippingAddress;
    }
}
