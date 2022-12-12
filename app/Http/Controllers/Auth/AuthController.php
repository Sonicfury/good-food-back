<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register api
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function register(AuthRequest $request): JsonResponse
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('customer');

        $success['token'] = $user->createToken('GoodFood')->plainTextToken;
        $success['user'] = UserResource::make($user);

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $success['token'] = $user->createToken('GoodFood')->plainTextToken;
            $success['user'] = UserResource::make($user);

            return $this->sendResponse($success, 'User login successfully.');
        }

        return $this->sendError('login failed or unauthorized');
    }
}
