<?php

namespace App\Services;

use App\Enuns\DeliveryType;
use App\Enuns\PaymentMethod;
use App\Enuns\PaymentType;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;

class OrderService
{
    public function create(
        User $customer,
        Restaurant $restaurant,
        DeliveryType $deliveryType,
        PaymentType $paymentType,
        PaymentMethod $paymentMethod
    ) {
        if ($deliveryType === DeliveryType::SELF_PICKUP) {
            
        }

        $customer->orders()->create([
            "restaurant_id" => $restaurant->id,

        ]);
    }
}
