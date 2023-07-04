<?php

namespace App\Http\Controllers\Api;

use App\Facades\Distance;
use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
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
     * @param StoreRestaurantRequest $request
     * @return JsonResponse
     */
    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        $request->validated();

        $restaurant = Restaurant::create($request->all());

        if ($request->file('image')) {
            $restaurant->addMediaFile($request->file('image'), "restaurant_image");
        }

        return $this->handleResponse(RestaurantResource::make($restaurant), 'Restaurant stored successfully.');
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
     * @param UpdateRestaurantRequest $request
     * @param Restaurant $restaurant
     * @return JsonResponse
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): JsonResponse
    {
        $request->validated();

        $restaurant->update($request->all());

        return $this->handleResponse(RestaurantResource::make($restaurant), 'Restaurant updated successfully.');
    }

    /**
     * Destroy the specified restaurant.
     *
     * @param Restaurant $restaurant
     * @return JsonResponse
     */
    public function destroy(Restaurant $restaurant): JsonResponse
    {
        $restaurant->delete();

        return $this->handleResponse([], 'Restaurant deleted successfully.');
    }
}
