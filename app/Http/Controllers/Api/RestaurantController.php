<?php

namespace App\Http\Controllers\Api;

use App\Facades\Distance;
use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\UpdateRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller
{
    /**
     * Display all restaurants.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $restaurants = isset($_GET['coords']) ? Distance::restaurant_with_km($_GET['coords']) : Restaurant::all();

        return $this->handleResponse(RestaurantResource::collection($restaurants), 'Restaurants found successfully.');
    }

    /**
     * Store the specified restaurant.
     *
     * @param UpdateRequest $request
     * @return void
     */
    public function store(UpdateRequest $request): void
    {
        //
    }

    /**
     * Display the specified restaurant.
     *
     * @param Restaurant $restaurant
     * @return JsonResponse
     */
    public function show(Restaurant $restaurant): JsonResponse
    {
        return $this->handleResponse(RestaurantResource::make($restaurant), 'Restaurant found successfully.');
    }

    /**
     * Update the specified restaurant.
     *
     * @param UpdateRequest $request
     * @param Restaurant $restaurant
     * @return void
     */
    public function update(UpdateRequest $request, Restaurant $restaurant): void
    {
        //
    }

    /**
     * Destroy the specified restaurant.
     *
     * @param UpdateRequest $request
     * @param Restaurant $restaurant
     * @return void
     */
    public function destroy(UpdateRequest $request, Restaurant $restaurant): void
    {
        //
    }
}
