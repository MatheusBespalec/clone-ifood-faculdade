<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function finish()
    {
        $restaurantId = session()->get("shopping-cart")->first()->get("restaurant_id");
        return view("orders.finish", [
            "restaurant" => Restaurant::findOrFail($restaurantId),
            'deliveryAddress' => auth()->user()->addresses()->whereActive(true)->first()
        ]);
    }
}
