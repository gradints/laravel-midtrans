<?php

namespace Gradints\LaravelMidtrans\Models;

abstract class PaymentMethod
{
    abstract public function getPaymentType(): string;

    abstract public function getPaymentPayload(): ?array;
}
