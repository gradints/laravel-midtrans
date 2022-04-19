<?php

namespace Gradints\LaravelMidtrans\Models;

class Customer
{
    public function __construct(
        private string $name,
        private string $email,
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
}
