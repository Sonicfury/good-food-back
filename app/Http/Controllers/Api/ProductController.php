<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(ProductResource::collection(Product::all()), 'Products found successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $request->validated();

        $product = Product::create($request->all());

        dd($request->file('image'));

        $product->addMediaFile($request->file('image'), "product_image");

        return $this->handleResponse(ProductResource::make($product), 'Product stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return $this->handleResponse(ProductResource::make($product), 'Product found successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {

        $request->validated();

        $product->update($request->all());

        $product->updateMediaFile($request->file('image'), "product_image");

        return $this->handleResponse(ProductResource::make($product), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return $this->handleResponse([], 'Product deleted successfully.');
    }
}
