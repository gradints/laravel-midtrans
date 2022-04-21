<?php

namespace Gradints\LaravelMidtrans\Interface;

interface HasApi
{
    public function getApiPaymentType(): string;

    public function getApiPaymentPayload(): array;
}
