<?php

use App\Enuns\OrderStatus;
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
            $table->tinyInteger("status");
            $table->tinyInteger("delivery_type");
            $table->tinyInteger("payment_type");
            $table->tinyInteger("payment_method");
            $table->string("zip_code")->nullable();
            $table->string("street")->nullable();
            $table->string("neighborhood")->nullable();
            $table->string("number")->nullable();
            $table->string("complement")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
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
