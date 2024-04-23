<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;
use App\Models\Penjualan;

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




Route::get("/", [LoginController::class, "index"]);
Route::post("/auth", [LoginController::class, "auth"])->name("auth");
Route::get("/auth/logout", [LoginController::class, "destroy"])->name('auth.logout');

Route::middleware(["isLogin"])->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"]);
    Route::get("/stock", [StockController::class, "index"]);
    Route::post("/stock/store", [StockController::class, "store"])->name('stock.store'); 
    Route::post("/stock/update/{id}", [StockController::class, "update"])->name('stock.update');
    Route::post("/stock/stock/{id}", [StockController::class, "updatestock"])->name('update');
    Route::get("/stock/delete/{id}", [StockController::class, "deletestock"])->name('stock.delete');


    Route::get("/penjualan", [PenjualanController::class, "index"])->name("penjualan");
    Route::get("/invoice", [PenjualanController::class, "invoice"])->name("invoice");
    Route::get("/penjualan/create", [PenjualanController::class, "form"])->name("penjualan.create");
    Route::post("/penjualan/invoice", [PenjualanController::class, "createInvoice"])->name("penjualan.invoice");
    Route::post("/penjualan/payment", [PenjualanController::class, "confirmPayment"])->name("penjualan.payment");
    Route::get("/penjualan/delete/{id}", [PenjualanController::class, "delete"])->name('penjualan.delete');


    Route::middleware("isAdmin")->group(function () {
        Route::get("/user", [UserController::class, "index"])->name("user");
        Route::get("/user/create", [UserController::class, "create"])->name("user.create");
        Route::post("/user/store", [UserController::class, "store"])->name("user.store");
        Route::post("/user/update/{id}", [UserController::class, "update"])->name("user.update");
        Route::get("/user/delete/{id}", [UserController::class, "destroy"])->name("user.delete");
    });
});

