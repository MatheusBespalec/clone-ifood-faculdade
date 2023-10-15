<?php

use App\Enuns\BrazilStates;
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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("name", 100);
            $table->char("zip_code", 10);
            $table->string("street", 100);
            $table->string("neighborhood", 100)->nullable();
            $table->string("number", 50);
            $table->string("complement", 50)->nullable();
            $table->string("city", 100);
            $table->boolean("active");
            $table->enum("state", array_map(fn (BrazilStates $state) => $state->value, BrazilStates::cases()));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("addresses", function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
        });
        Schema::dropIfExists('addresses');
    }
};
