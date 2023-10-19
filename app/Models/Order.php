<?php

namespace App\Models;

use App\Enuns\DeliveryType;
use App\Enuns\OrderStatus;
use App\Enuns\PaymentMethod;
use App\Enuns\PaymentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "user_id",
        "restaurant_id",
        "delivery_type",
        "payment_type",
        "payment_method",
        "zip_code",
        "street",
        "neighborhood",
        "number",
        "complement",
        "city",
        "state",
    ];

    protected $casts = [
        "status" => OrderStatus::class,
        "delivery_type" => DeliveryType::class,
        "payment_type" => PaymentType::class,
        "payment_method" => PaymentMethod::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->as("items")
            ->withPivot("quantity", "price");
    }
}
