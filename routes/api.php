<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('auth/register', [AuthenticationController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->as('auth.')->group(function () {
        Route::get('access-tokens', [UserController::class, 'activeSessions'])->name('access-tokens');
        Route::delete('access-tokens', [AuthenticationController::class, 'revokeCurrentToken'])->name('revoke-current-token');
        Route::delete('access-tokens/all', [AuthenticationController::class, 'revokeTokens'])->name('revoke-tokens');
        Route::delete('access-tokens/exclude-current', [AuthenticationController::class, 'revokeTokensExcludeCurrent'])->name('revoke-tokens-exclude-current');
        Route::delete('access-tokens/{token}', [AuthenticationController::class, 'revokeToken'])->name('revoke-specific-token');
        Route::get('user', [AuthenticationController::class, 'authenticatedUser'])->name('get-auth-user');
    });

    Route::prefix('user')->as('user.')->group(function () {
        Route::put('update', [UserController::class, 'update'])->name('update');
        Route::put('update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');
        Route::put('update-password', [UserController::class, 'updatePassword'])->name('update-password');
    });
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('ads', AdController::class);
