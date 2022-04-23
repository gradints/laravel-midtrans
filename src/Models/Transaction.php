<?php

namespace Gradints\LaravelMidtrans\Models;

class Transaction
{
    /** @var Gradints\LaravelMidtrans\Models\Item[] */
    private array $items = [];

    public function __construct(
        private string $orderId,
        private int $grossAmount,
        ?array $items = []
    ) {
        foreach ($items as $item) {
            $this->items[] = new Item($item);
        }
    }

    /**
     * Order Id of the transaction. Must be unique and only used once for the order.
     * Allowed character are Alphanumeric, dash(-), underscore(_), tilde (~), and dot (.)
     * String, max 50.
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return str_replace('/', '-', $this->orderId);
    }

    /**
     * Total transaction amount in IDR.
     * Integer Do not support decimal.
     *
     * @return int
     */
    public function getGrossAmount(): int
    {
        return $this->grossAmount;
    }

    /**
     * @return Gradints\LaravelMidtrans\Models\Item[]
     */
    public function getItems(): array
    {
        return array_map(fn (Item $item) => $item->getData(), $this->items);
    }
}
