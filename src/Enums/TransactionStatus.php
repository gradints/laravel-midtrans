<?php

namespace Gradints\LaravelMidtrans\Enums;

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

    /**
     * Match transaction status with their action defined in config.payment_notification
     * returns in format [path/to/classname, functionToBeCalled]
     * Fallback to empty array if the config is not defined.
     *
     * @return array
     */
    public function getAction(): array
    {
        return config('midtrans.payment_notification.' . $this->value, []);
    }
}
