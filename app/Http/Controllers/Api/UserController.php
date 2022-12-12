<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display all users.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(UserResource::collection(User::all()), 'Users found successfully.');
    }

    /**
     * Store the specified user.
     *
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified user.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);

        return $this->sendResponse(UserResource::make($user), 'User found successfully.');
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $user->update([
            'email' => $request->email ?? $user->email,
            'firstname' => $request->firstname ?? $user->firstname,
            'lastname' => $request->lastname ?? $user->lastname,
            'primaryPhone' => $request->primaryPhone ?? $user->primaryPhone,
            'secondaryPhone' => $request->secondaryPhone ?? $user->secondaryPhone,
        ]);

        return $this->sendResponse(UserResource::make($user), 'User updated successfully.');
    }

//    /**
//     * Destroy the specified user.
//     *
//     * @param $id
//     * @return JsonResponse
//     */
//    public function destroy($id): JsonResponse
//    {
//        $user = User::findOrFail($id);
//
//        $user->disabled_at = Carbon::now();
//        $user->save();
//
//        return $this->sendResponse(UserResource::make($user), 'User disabled successfully.');
//    }
}
