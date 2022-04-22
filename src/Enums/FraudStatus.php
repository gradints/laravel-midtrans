<?php

namespace Gradints\LaravelMidtrans\Enums;

enum FraudStatus: string
{
    case ACCEPT = 'accept';
    case DENY = 'deny';
    case CHALLENGE = 'challenge';
}
