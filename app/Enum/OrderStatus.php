<?php

namespace App\Enum;

enum OrderStatus: string
{
    case DELIVERED = "DELIVERED";
    case CANCELED = "CANCELED";
    case IN_PROGRESS = "IN_PROGRESS";
    case AWAITING_PAYMENT = "AWAITING_PAYMENT";
}
