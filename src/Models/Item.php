<?php

namespace Gradints\LaravelMidtrans\Models;

class Item
{
    public function __construct(private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }
}
