<?php

namespace App\Enuns;

enum DeliveryPaymentMethod: int
{
    case MONEY = 1;
    case MASTERCARD_CREDIT = 2;
    case MASTERCARD_DEBIT = 3;
    case VISA_CREDIT = 4;
    case VISA_DEBIT = 5;
    case VR_BEN = 6;

    public function label(): string
    {
        return match ($this) {
            self::MONEY => "Dinheiro",
            self::MASTERCARD_DEBIT => "Mastercard - Débito",
            self::VISA_CREDIT => "Visa - Crédito",
            self::VISA_DEBIT => "Visa - Débito",
            self::VR_BEN => "Ben Refeição",
        };
    }
}
