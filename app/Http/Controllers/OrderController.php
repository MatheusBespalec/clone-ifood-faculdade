<?php

namespace App\Http\Controllers;

use App\Enuns\DeliveryType;
use App\Enuns\OrderStatus;
use App\Enuns\PaymentType;
use App\Livewire\Cart;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;

class OrderController extends Controller
{
    public function finish()
    {
        $restaurantId = session()->get("shopping-cart")->first()->get("restaurant_id");
        return view("orders.finish", [
            "restaurant" => Restaurant::findOrFail($restaurantId),
            'deliveryAddress' => auth()->user()->addresses()->active()->first()
        ]);
    }

    public function store(Request $request, SessionManager $sessionManager)
    {
        DB::transaction(function () use ($request, $sessionManager) {
            $deliveryType = DeliveryType::from($request->delivery_type);
            $user = auth()->user();
            $address = $deliveryType === DeliveryType::SELF_PICKUP
                ? Restaurant::findOrFail($request->restaurant)
                : $user->addresses()->active()->first();

            $order = Order::create([
                "status" => OrderStatus::IN_PROGRESS,
                "user_id" => $user->id,
                "restaurant_id" => $request->restaurant,
                "delivery_type" => $deliveryType,
                "payment_type" => PaymentType::from($request->payment_type),
                "payment_method" => PaymentType::from($request->payment_method),
                "zip_code" => $address->zip_code,
                "street" => $address->street,
                "neighborhood" => $address->neighborhood,
                "number" => $address->number,
                "complement" => $address->complement,
                "city" => $address->city,
                "state" => $address->state,
            ]);

            foreach ($sessionManager->get("shopping-cart") as $cartItem) {
                $order->products()->attach($cartItem->get("id"), [
                    "quantity" => $cartItem->get("quantity"),
                    "unit_price" => $cartItem->get("price"),
                ]);
            }

            $sessionManager->forget(Cart::DEFAULT_INSTANCE);
            Toaster::success("Seu pedido foi criado e já esta em preparação");
        });
        return redirect()->route("home");
    }

    public function index()
    {
        return view("orders.index", [
            "orders" => auth()->user()->orders()->orderBy("id", "DESC")->get()
        ]);
    }
}
