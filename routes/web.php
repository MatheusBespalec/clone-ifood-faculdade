<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', "/restaurantes")->name("home");
Route::name("restaurants.")->prefix("restaurantes") ->group(function () {
    Route::get("/", [RestaurantController::class, "index"])->name("index");
    Route::get("/{restaurant}", [RestaurantController::class, "show"])
        ->whereNumber("restaurant")
        ->name("show");
});

Route::name("orders.")->prefix("pedido") ->group(function () {
    Route::get("/finalizar", [OrderController::class, "finish"])->name("finish");
});

Route::name("auth.")->group(function () {
    Route::get("/auth/google", [AuthController::class, "handleGoogleProvider"])->name("google");
    Route::get("/auth/google-redirect", [AuthController::class, "redirectToGoogleProvider"])->name("google-redirect");
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';
