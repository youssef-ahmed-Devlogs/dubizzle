<?php

use App\Http\Controllers\Dashboard\AdController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('ads', AdController::class);
});

Route::get('/login', [DashboardController::class, 'login'])->name('login')->middleware('guest');
