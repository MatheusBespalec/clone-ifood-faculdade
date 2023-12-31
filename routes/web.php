<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
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
    Route::get("/relatorios/{restaurant}", [ReportController::class, "resturant"])->name("restaurant");
    Route::get("/", [RestaurantController::class, "index"])->name("index");
    Route::get("/{restaurant}", [RestaurantController::class, "show"])
        ->whereNumber("restaurant")
        ->name("show");
});

Route::name("orders.")->prefix("pedido") ->group(function () {
    Route::get("/finalizar", [OrderController::class, "finish"])->name("finish");
    Route::post("/", [OrderController::class, "store"])->name("store");
    Route::get("/", [OrderController::class, "index"])->name("index");
    Route::get("/relatorios", [ReportController::class, "orders"])->name("reports");
});

Route::name("auth.")->group(function () {
    Route::get("/auth/google", [AuthController::class, "handleGoogleProvider"])->name("google");
    Route::get("/auth/google-redirect", [AuthController::class, "redirectToGoogleProvider"])->name("google-redirect");
    Route::get("/auth/facebook", [AuthController::class, "handleFacebookProvider"])->name("facebook");
    Route::get("/auth/facebook-redirect", [AuthController::class, "redirectToFacebookProvider"])->name("facebook-redirect");
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';
