<?php

use App\Http\Controllers\Auth\LoginController;
use App\Modules\MaiExcellent\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
