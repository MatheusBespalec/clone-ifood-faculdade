<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return view("restaurants.index");
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load("products");
        return view("restaurants.show", compact("restaurant"));
    }
}
