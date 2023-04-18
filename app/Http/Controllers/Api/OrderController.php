<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(OrderResource::collection(Order::all()), 'Orders found successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $customer
     * @return JsonResponse
     */
    public function customer_orders(User $customer): JsonResponse
    {
        return $this->handleResponse(OrderResource::collection(Order::where('customer_id', $customer->id)->get()), 'Orders found successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Restaurant $restaurant
     * @return JsonResponse
     */
    public function restaurant_orders(Restaurant $restaurant): JsonResponse
    {
        return $this->handleResponse(OrderResource::collection(Order::where('restaurant_id', $restaurant->id)->get()), 'Orders found successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $employee
     * @return JsonResponse
     */
    public function employee_orders(User $employee): JsonResponse
    {
        return $this->handleResponse(OrderResource::collection(Order::where('employee_id', $employee->id)->get()), 'Orders found successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $request->validated();

        $order = Order::create($request->all());

        return $this->handleResponse(OrderResource::make($order), 'Order stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function show(Order $order): JsonResponse
    {
        return $this->handleResponse(OrderResource::make($order), 'Order found successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $request->validated();

        $order->update($request->all());

        return $this->handleResponse(OrderResource::make($order), 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return $this->handleResponse([], 'Order deleted successfully.');
    }
}
