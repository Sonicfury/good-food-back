<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Promote\StorePromoteRequest;
use App\Http\Requests\Promote\UpdatePromoteRequest;
use App\Http\Resources\PromoteResource;
use App\Models\Promote;
use Illuminate\Http\JsonResponse;

class PromoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(PromoteResource::collection(Promote::all()), 'Promotes found successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePromoteRequest $request
     * @return JsonResponse
     */
    public function store(StorePromoteRequest $request): JsonResponse
    {
        $request->validated();

        $promote = Promote::create($request->all());

        return $this->handleResponse(PromoteResource::make($promote), 'Promote stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Promote $promote
     * @return JsonResponse
     */
    public function show(Promote $promote): JsonResponse
    {
        return $this->handleResponse(PromoteResource::make($promote), 'Promote found successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePromoteRequest $request
     * @param Promote $promote
     * @return JsonResponse
     */
    public function update(UpdatePromoteRequest $request, Promote $promote): JsonResponse
    {
        $request->validated();

        $promote->update($request->all());

        return $this->handleResponse(PromoteResource::make($promote), 'Promote updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Promote $promote
     * @return JsonResponse
     */
    public function destroy(Promote $promote): JsonResponse
    {
        $promote->delete();

        return $this->handleResponse([], 'Promote deleted successfully.');
    }
}
