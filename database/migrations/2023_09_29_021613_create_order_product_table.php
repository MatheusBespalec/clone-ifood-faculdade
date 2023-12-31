<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Product::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->tinyInteger("quantity");
            $table->decimal("unit_price", 7);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("order_product", function (Blueprint $table) {
            $table->dropForeignIdFor(Order::class);
            $table->dropForeignIdFor(Product::class);
        });
        Schema::dropIfExists('order_product');
    }
};
