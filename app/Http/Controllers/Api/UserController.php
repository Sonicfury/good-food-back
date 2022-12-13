<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display all users.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->handleResponse(UserResource::collection(User::all()), 'Users found successfully.');
    }

    /**
     * Store the specified user.
     *
     * @param UpdateRequest $request
     */
    public function store(UpdateRequest $request)
    {
        //
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->handleResponse(UserResource::make($user), 'User found successfully.');
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        $request->validated();

        $data = $request->all();

        $data['birthDate'] = Carbon::createFromFormat('d-m-Y', $data['birthDate'])->format('Y-m-d');

        $user->update($data);

        return $this->handleResponse(UserResource::make($user), 'User updated successfully.');
    }
}