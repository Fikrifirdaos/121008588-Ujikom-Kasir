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
Route::get('/biling', function () {
    return view('pages.stock');
});

Route::get("/", [LoginController::class, "index"]);
Route::post("/auth", [LoginController::class, "auth"])->name("auth");
Route::get("/auth/logout", [LoginController::class, "logout"])->name('auth.logout');

Route::get("/stock", [StockController::class, "index"]);
