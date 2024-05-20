<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $this->userService->getByEmail($request->email);

            return response()->json([
                'status' => true,
                'error' => null,
                'token' => $user->createToken('api-token')->plainTextToken,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'error' => 'invalid credentials',
            'token' => null,
        ], 401);
    }
}
