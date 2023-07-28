<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CategoryController;
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

Route::post('auth/access-tokens', [AuthenticationController::class, 'createToken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('auth/access-tokens', [AuthenticationController::class, 'revokeCurrentToken']);
    Route::delete('auth/access-tokens/all', [AuthenticationController::class, 'revokeTokens']);
    Route::delete('auth/access-tokens/exclude-current', [AuthenticationController::class, 'revokeTokensExcludeCurrent']);
    Route::delete('auth/access-tokens/{token}', [AuthenticationController::class, 'revokeToken']);
    Route::get('auth/user', [AuthenticationController::class, 'authenticatedUser']);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('ads', AdController::class);
