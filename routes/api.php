<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/* --- Not connected user --- */
Route::post('/menus/{menu}/offers', [OfferController::class, 'menu_store']);
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
    Route::match(['put', 'patch'], '/restaurants/{restaurant}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);

    /* --- Orders --- */
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/customers/{user}/orders', [OrderController::class, 'customer_orders']);
    Route::get('/restaurants/{restaurant}/orders', [OrderController::class, 'restaurant_orders']);
    Route::get('/employees/{user}/orders', [OrderController::class, 'employee_orders']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
    Route::match(['put', 'patch'], '/orders/{order}', [OrderController::class, 'update']);
    Route::delete('/orders/{order}', [OrderController::class, 'destroy']);
    Route::post('/orders', [OrderController::class, 'store']);


    /* --- Categories --- */
    Route::apiResource('/categories', CategoryController::class);

    /* --- Products --- */
    Route::apiResource('/products', ProductController::class);
    Route::post('/products/{product}/offers', [OfferController::class, 'product_store']);

    /* --- Offers --- */
    Route::get('/offers', [OfferController::class, 'index']);
    Route::get('/offers/{offer}', [OfferController::class, 'show']);
    Route::match(['put', 'patch'], '/offers/{offer}', [OfferController::class, 'update']);
    Route::delete('/offers/{offer}', [OfferController::class, 'destroy']);

    /* --- Menus --- */
    Route::apiResource('/menus', MenuController::class);

});
