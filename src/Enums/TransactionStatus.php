<?php

namespace Gradints\LaravelMidtrans\Enums;

use Illuminate\Support\Facades\Config;

// https://api-docs.midtrans.com/?php#transaction-status
enum TransactionStatus: string
{
    case AUTHORIZE = 'authorize';
    case CAPTURE = 'capture';
    case SETTLEMENT = 'settlement';
    case DENY = 'deny';
    case PENDING = 'pending';
    case CANCEL = 'cancel';
    case REFUND = 'refund';
    case PARTIAL_REFUND = 'partial_refund';
    case CHARGEBACK = 'chargeback';
    case PARTIAL_CHARGEBACK = 'partial_chargeback';
    case EXPIRE = 'expire';
    case FAILURE = 'failure';

    public function getAction(): array
    {
        return Config::get('midtrans.payment_notification.' . $this->value, []);
    }

    // Credit card: authorize > capture > settlement
    // Other: pending > settlement
}
