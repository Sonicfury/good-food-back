<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Menu;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(OfferResource::collection(Offer::all()), 'Offers found successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Menu $menu
     * @param StoreOfferRequest $request
     * @return JsonResponse
     */
    public function menu_store(Menu $menu, StoreOfferRequest $request): JsonResponse
    {
        $request->validated();

        $offer = Offer::create($request->all());

        $menu->offers()->save($offer);

        return $this->handleResponse(OfferResource::make($offer), 'Offer stored successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Product $product
     * @param StoreOfferRequest $request
     * @return JsonResponse
     */
    public function product_store(Product $product, StoreOfferRequest $request): JsonResponse
    {
        $request->validated();

        $offer = Offer::create($request->all());

        $product->offers()->save($offer);

        return $this->handleResponse(OfferResource::make($offer), 'Offer stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     * @return JsonResponse
     */
    public function show(Offer $offer): JsonResponse
    {
        return $this->handleResponse(OfferResource::make($offer), 'Offer found successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOfferRequest $request
     * @param Offer $offer
     * @return JsonResponse
     */
    public function update(UpdateOfferRequest $request, Offer $offer): JsonResponse
    {
        $request->validated();

        $offer->update($request->all());

        return $this->handleResponse(OfferResource::make($offer), 'Offer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Offer $offer
     * @return JsonResponse
     */
    public function destroy(Offer $offer): JsonResponse
    {
        $offer->delete();

        return $this->handleResponse([], 'Offer deleted successfully.');
    }
}
