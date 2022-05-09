<?php

namespace Gradints\LaravelMidtrans\Models;

use Gradints\LaravelMidtrans\Exceptions\InvalidOrderIdFormatException;

class Transaction
{
    /**
     * Order Id of the transaction. Must be unique and only used once for the order.
     * Allowed character: Alphanumeric, dash(-), underscore(_), tilde (~), and dot (.)
     * String, max 50.
     *
     * @var string
     */
    private string $orderId;

    /**
     * Total payment, must equals Items' price times qty.
     * Integer Do not support decimal.
     *
     * @var int
     */
    private int $grossAmount;

    /**
     * Required name, qty, price. Other attributes are optional.
     *
     * @var Gradints\LaravelMidtrans\Models\Item[]
     */
    private iterable $items = [];

    /**
     * Create a new Transaction instance.
     *
     * @param  string  $orderId
     * @param  int  $grossAmount
     * @param  \Gradints\LaravelMidtrans\Models\Item[] $items
     */
    public function __construct(string $orderId, int $grossAmount, iterable $items = [])
    {
        $this->setOrderId($orderId);

        $this->grossAmount = $grossAmount;

        foreach ($items as $item) {
            $this->items[] = new Item($item);
        }
    }

    /**
     * Order Id of the transaction. Must be unique and only used once for the order.
     *
     * @return string
     */
    public function setOrderId(string $orderId): void
    {
        $this->validateOrderId($orderId);

        $this->orderId = $orderId;
    }

    /**
     * Order Id of the transaction.
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * Total transaction amount in IDR.
     * Integer Do not support decimal.
     *
     * @return int
     */
    public function setGrossAmount(int $grossAmount): void
    {
        $this->grossAmount = $grossAmount;
    }

    /**
     * Total transaction amount in IDR.
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

    /**
     * Validate orderId according to midtrans specification.
     * https://api-docs.midtrans.com/#transaction-details-object
     *
     * @param  string  $orderId
     * @return void
     * @throw  \Gradints\LaravelMidtrans\Exceptions\InvalidOrderIdFormatException
     */
    private function validateOrderId(string $orderId)
    {
        if (strlen($orderId) > 50) {
            throw new InvalidOrderIdFormatException();
        }
        if (preg_match('/[^a-zA-Z0-9_\-~\.]/', $orderId)) {
            throw new InvalidOrderIdFormatException();
        }
    }
}
