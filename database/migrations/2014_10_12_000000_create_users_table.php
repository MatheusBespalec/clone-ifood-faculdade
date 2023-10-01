<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
//            $table->string('name');
//            $table->string('email')->unique();
//            $table->char("phone", 11)->unique()->nullable();
//            $table->char("email_token", 6)->nullable();
//            $table->dateTime("email_token_expiration", 6)->nullable();
//            $table->char("phone_token", 6)->nullable();
//            $table->dateTime("phone_token_expiration", 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
