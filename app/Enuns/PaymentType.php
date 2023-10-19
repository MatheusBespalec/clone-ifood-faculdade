<?php

namespace App\Enuns;

enum PaymentType: int
{
    case WEBSITE_PAYMENT = 1;
    case CASH_ON_DELIVERY = 2;
}
