<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ordered\StoreOrderedRequest;
use App\Http\Requests\Ordered\UpdateOrderedRequest;
use App\Http\Resources\OrderedResource;
use App\Models\Order;
use App\Models\Ordered;
use Illuminate\Http\JsonResponse;

class OrderedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(OrderedResource::collection(Ordered::all()), 'Ordereds found successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function order_ordereds(Order $order): JsonResponse
    {
        return $this->handleResponse(OrderedResource::collection(Ordered::where('order_id', $order->id)->get()), 'Ordereds found successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderedRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderedRequest $request): JsonResponse
    {
        $request->validated();

        $ordered = Ordered::create($request->all());

        return $this->handleResponse(OrderedResource::make($ordered), 'Ordered stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Ordered $ordered
     * @return JsonResponse
     */
    public function show(Ordered $ordered): JsonResponse
    {
        return $this->handleResponse(OrderedResource::make($ordered), 'Ordered found successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderedRequest $request
     * @param Ordered $ordered
     * @return JsonResponse
     */
    public function update(UpdateOrderedRequest $request, Ordered $ordered): JsonResponse
    {
        $request->validated();

        $ordered->update($request->all());

        return $this->handleResponse(OrderedResource::make($ordered), 'Ordered updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ordered $ordered
     * @return JsonResponse
     */
    public function destroy(Ordered $ordered): JsonResponse
    {
        $ordered->delete();

        return $this->handleResponse([], 'Ordered deleted successfully.');
    }
}
