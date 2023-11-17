<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    public function orders()
    {
        $orders = Order::with("products")->paginate(10);
        return view("orders.report", compact("orders"));
    }

    public function resturant(Restaurant $restaurant)
    {
        $restaurant->load("orders");
        $report = [];
        $dates = array_map(fn ($number) => date("d/m/Y", strtotime("-{$number} days")), range(1, 30));
        foreach ($dates as $date) {
            $report[$date] = [
                "date" => $date,
                "orders_count" => 0,
                "total" => 0
            ];
        }
        foreach ($restaurant->orders as $order) {
            $date = $order->created_at->format("d/m/Y");
            $report[$date]["orders_count"]++;
            $report[$date]["total"] += $order->getTotal();
        }

        foreach ($report as $key => $value) {
            $report[$key]["total"] = "R$ " . number_format($value["total"], 2, ",", ".");
        }

        return view("restaurants.report", compact("restaurant", "report"));
    }
}
