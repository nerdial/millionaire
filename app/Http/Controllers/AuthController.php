<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthService $authService)
    {
        $registerData = $request->validated();
        $user = $authService->register($registerData);
        return response()->json([
            'data' => [
                'token' => $authService->createNewToken($user)
            ]
        ]);
    }

    public function login(LoginRequest $request, AuthService $authService)
    {
        $loginData = $request->validated();

        if (!Auth::attempt($loginData)) {
            abort(401, 'Credentials do not match');
        }
        $user = auth()->user();
        return response()->json([
            'data' => [
                'token' => $authService->createNewToken($user)
            ]
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }


}
