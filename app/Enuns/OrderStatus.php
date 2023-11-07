<?php

namespace App\Enuns;

enum OrderStatus: int
{
    case IN_PROGRESS = 1;
    case CANCELED = 2;
    case DELIVERED = 3;

    public function label()
    {
        return match ($this) {
            self::IN_PROGRESS => "EM PREPARAÇÃO",
            self::CANCELED => "CANCELADO",
            self::DELIVERED => "ENTREGUE",
        };
    }
}
