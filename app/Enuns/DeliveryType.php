<?php

namespace App\Enuns;

enum DeliveryType: int
{
    case ADDRESS_DELIVERY = 1;
    case SELF_PICKUP = 2;
}
