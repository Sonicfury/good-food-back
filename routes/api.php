<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PromoteController;
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

/* --- Restaurants --- */
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);

/* --- Connected user --- */
Route::middleware('auth:sanctum')->group(function () {

    /* --- Users --- */
    Route::apiResource('/users', UserController::class);

    /* --- Restaurants --- */
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);

    /* --- Categories --- */
    Route::apiResource('/categories', CategoryController::class);

    /* --- Products --- */
    Route::apiResource('/products', ProductController::class);

    /* --- Promotes --- */
    Route::apiResource('/promotes', PromoteController::class);
});
