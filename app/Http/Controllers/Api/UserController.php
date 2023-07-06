<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function store(UpdateUserRequest $request)
    {
        $request->validated();

        $user = User::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => Hash::make('1234azer'),
        ]);

        $user->assignRole($request->role);

        return $this->handleResponse(UserResource::make($user), 'User stored successfully.');
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
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $request->validated();

        $data = $request->all();

        $data['birthDate'] = Carbon::createFromFormat('d-m-Y', $data['birthDate'])->format('Y-m-d');

        $user->update($data);

        return $this->handleResponse(UserResource::make($user), 'User updated successfully.');
    }

    /**
     * Destroy the specified user.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->disabled_at = Carbon::now();

        return $this->handleResponse([], 'User deleted successfully.');
    }
}
