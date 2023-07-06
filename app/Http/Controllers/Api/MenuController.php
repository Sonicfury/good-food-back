<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(MenuResource::collection(Menu::all()), 'Menus found successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMenuRequest $request
     * @return JsonResponse
     */
    public function store(StoreMenuRequest $request): JsonResponse
    {
        $request->validated();

        $menu = Menu::create($request->all());

        return $this->handleResponse(MenuResource::make($menu), 'Menu stored successfully.');
    }

    /**
     * @param Menu $menu
     * @param Product $product
     * @return JsonResponse
     */
    public function menu_product(Menu $menu, Product $product)
    {
        $menu->products()->attach($product->id);

        return $this->handleResponse(MenuResource::make($menu), 'Product attach at menu successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return JsonResponse
     */
    public function show(Menu $menu): JsonResponse
    {
        return $this->handleResponse(MenuResource::make($menu), 'Menu found successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMenuRequest $request
     * @param Menu $menu
     * @return JsonResponse
     */
    public function update(UpdateMenuRequest $request, Menu $menu): JsonResponse
    {
        $request->validated();

        $menu->update($request->all());

        return $this->handleResponse(MenuResource::make($menu), 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @return JsonResponse
     */
    public function destroy(Menu $menu): JsonResponse
    {
        $menu->delete();

        return $this->handleResponse([], 'Menu deleted successfully.');
    }
}
