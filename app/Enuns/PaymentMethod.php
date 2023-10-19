<?php

namespace App\Enuns;

enum PaymentMethod: int
{
    case PIX = 1;
    case MONEY = 2;
    case VISA_CREDIT = 3;
    case VISA_DEBIT = 4;

    public function label(): string
    {
        return match ($this) {
            self::PIX => "Pix",
            self::MONEY => "Dinheiro",
            self::VISA_CREDIT => "Visa - Crédito",
            self::VISA_DEBIT => "Visa - Débito",
        };
    }
}
