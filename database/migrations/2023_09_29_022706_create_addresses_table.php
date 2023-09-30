<?php

use App\Enum\BrazilStates;
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
            $table->string("street", 100);
            $table->string("neighborhood", 100);
            $table->string("number", 50);
            $table->string("complement", 50);
            $table->string("reference");
            $table->string("city", 100);
            $table->enum("state", BrazilStates::cases());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
