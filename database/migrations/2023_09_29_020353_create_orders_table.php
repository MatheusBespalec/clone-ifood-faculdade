<?php

use App\Enum\OrderStatus;
use App\Models\Restaurant;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignIdFor(Restaurant::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->enum("status", array_map(fn (OrderStatus $status) => $status->value, OrderStatus::cases()));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("orders", function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Restaurant::class);
        });
        Schema::dropIfExists('orders');
    }
};
