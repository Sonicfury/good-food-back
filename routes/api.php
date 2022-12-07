<?php

use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/* --- Not connected user --- */

/* --- Authentication --- */
Route::post('/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])
    ->name('login');

/* --- Password --- */
//Route::post('/forgot-password', [PasswordResetController::class, 'store']);
//Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
//    ->name('password.reset');
//Route::post('/reset-password', [NewPasswordController::class, 'store']);


/* --- Connected user --- */
Route::middleware('auth:sanctum')->group(function () {

    /* --- Users --- */
    Route::apiResource('/users', UserController::class);

    /* --- Restaurants --- */
    Route::apiResource('/restaurants', RestaurantController::class);
});
