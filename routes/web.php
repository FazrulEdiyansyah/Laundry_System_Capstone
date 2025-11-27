<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/order/{order}', [CustomerDashboardController::class, 'show'])->name('customer.order.show');
    Route::get('/customer/order/tracking/{order}', [CustomerDashboardController::class, 'tracking'])->name('customer.order.tracking');
    Route::get('/customer/order/create', [CustomerDashboardController::class, 'create'])->name('customer.order.create');
    Route::post('/customer/order', [CustomerDashboardController::class, 'store'])->name('customer.order.store');
});
