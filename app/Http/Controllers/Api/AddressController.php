<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(AddressResource::collection(Address::all()), 'Addresses found successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param User $user
     * @param StoreAddressRequest $request
     * @return JsonResponse
     */
    public function store(User $user, StoreAddressRequest $request): JsonResponse
    {
        $request->validated();

        $address = Address::create($request->all());

        $user->addresses()->save($address);

        return $this->handleResponse(AddressResource::make($address), 'Address stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function show(Address $address): JsonResponse
    {
        return $this->handleResponse(AddressResource::make($address), 'Address found successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddressRequest $request
     * @param Address $address
     * @return JsonResponse
     */
    public function update(UpdateAddressRequest $request, Address $address): JsonResponse
    {
        $request->validated();

        $address->update($request->all());

        return $this->handleResponse(AddressResource::make($address), 'Address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy(Address $address): JsonResponse
    {
        $address->delete();

        return $this->handleResponse([], 'Address deleted successfully.');
    }
}
