<?php

namespace Gradints\LaravelMidtrans\Models;

class Transaction
{
    public function __construct(
        private string $orderId,
        private int $grossAmount
    ) {
    }

    /**
     * Order Id of the transaction.
     * Allowed Symbols are dash(-), underscore(_), tilde (~), and dot (.)
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return str_replace('/', '-', $this->orderId);
    }

    /**
     * Total transaction amount in IDR.
     * Do not support decimal.
     *
     * @return int
     */
    public function getGrossAmount(): int
    {
        return $this->grossAmount;
    }
}
