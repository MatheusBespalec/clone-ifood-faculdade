<?php

use App\Enum\BrazilStates;
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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->string("thumbnail")->nullable();
            $table->string("description")->nullable();
            $table->string("street", 100)->nullable();
            $table->string("neighborhood", 100)->nullable();
            $table->string("number", 50)->nullable();
            $table->string("city", 100)->nullable();
            $table->char("zip_code", 9)->nullable();
            $table->enum("state", array_map(fn (BrazilStates $state) => $state->value, BrazilStates::cases()))
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
