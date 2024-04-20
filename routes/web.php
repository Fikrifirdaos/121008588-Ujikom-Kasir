<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;

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

Route::get('/dashboard', function () {
    return view('dashboard.index');
});


Route::get("/", [LoginController::class, "index"]);
Route::post("/auth", [LoginController::class, "auth"])->name("auth");
Route::get("/auth/logout", [LoginController::class, "destroy"])->name('auth.logout');

Route::middleware(["isLogin"])->group(function () {
    Route::get("/stock", [StockController::class, "index"]);
    Route::post("/stock/store", [StockController::class, "store"])->name('stock.store'); 
    Route::post("/stock/update/{id}", [StockController::class, "update"])->name('stock.update');
    Route::get("/stock/delete/{id}", [StockController::class, "destroy"])->name('stock.delete');
});

