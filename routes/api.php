<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderedController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MediaController;
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

/* --- Products --- */
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

/* --- Menus --- */
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/{menu}', [MenuController::class, 'show']);

/* --- Offers --- */
Route::get('/offers', [OfferController::class, 'index']);
Route::get('/offers/{offer}', [OfferController::class, 'show']);

/* --- Categories --- */
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

/* --- Connected user --- */
Route::middleware('auth:sanctum')->group(function () {

    Route::group(['middleware' => ['role:customer|admin|employee']], function () {

        /* --- Users --- */
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::match(['put', 'patch'], '/users/{user}', [UserController::class, 'update']);

        /* --- Addresses --- */
        Route::get('/addresses/{address}', [AddressController::class, 'show']);
        Route::match(['put', 'patch'], '/addresses/{address}', [AddressController::class, 'update']);
        Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);
        Route::post('/users/{user}/addresses', [AddressController::class, 'store']);

        /* --- Orders --- */
        Route::get('/customers/{user}/orders', [OrderController::class, 'customer_orders']);
        Route::get('/orders/{order}', [OrderController::class, 'show']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::match(['put', 'patch'], '/orders/{order}', [OrderController::class, 'update']);
        Route::delete('/orders/{order}', [OrderController::class, 'destroy']);

        /* --- Ordereds --- */
        Route::get('/ordereds', [OrderedController::class, 'index']);
        Route::get('/orders/{order}/ordereds', [OrderedController::class, 'order_ordereds']);
        Route::get('/ordereds/{ordered}', [OfferController::class, 'show']);
        Route::match(['put', 'patch'], '/ordereds/{ordered}', [OrderedController::class, 'update']);
        Route::delete('/ordereds/{ordered}', [OrderedController::class, 'destroy']);
        Route::post('/ordereds', [OrderedController::class, 'store']);

    });

    Route::group(['middleware' => ['role:admin|employee']], function () {

        /* --- Users --- */
        Route::get('/users', [UserController::class, 'index']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
        Route::post('/users', [UserController::class, 'store']);

        /* --- Addresses --- */
        Route::get('/addresses', [AddressController::class, 'index']);

        /* --- Medias --- */
        Route::post('/medias', [MediaController::class, 'addMedia']);

        /* --- Restaurants --- */
        Route::match(['put', 'patch'], '/restaurants/{restaurant}', [RestaurantController::class, 'update']);
        Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);
        Route::post('/restaurants', [RestaurantController::class, 'store']);

        /* --- Orders --- */
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/restaurants/{restaurant}/orders', [OrderController::class, 'restaurant_orders']);
        Route::get('/employees/{user}/orders', [OrderController::class, 'employee_orders']);

        /* --- Categories --- */
        Route::match(['put', 'patch'], '/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
        Route::post('/categories', [CategoryController::class, 'store']);

        /* --- Products --- */
        Route::match(['put', 'patch'], '/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);
        Route::post('/products', [ProductController::class, 'store']);

        /* --- Menus --- */
        Route::match(['put', 'patch'], '/menus/{menu}', [MenuController::class, 'update']);
        Route::delete('/menus/{menu}', [MenuController::class, 'destroy']);
        Route::post('/menus', [MenuController::class, 'store']);
        Route::post('/menus/{menu}/products/{product}', [MenuController::class, 'menu_product']);

        /* --- Offers --- */
        Route::match(['put', 'patch'], '/offers/{offer}', [OfferController::class, 'update']);
        Route::delete('/offers/{offer}', [OfferController::class, 'destroy']);
        Route::post('/products/{product}/offers', [OfferController::class, 'product_store']);
        Route::post('/menus/{menu}/offers', [OfferController::class, 'menu_store']);
    });
});
