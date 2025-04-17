<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\auth\AuthLogin;

class AuthController extends Controller
{
    public function login (AuthLogin $request): JsonResponse
    {
        $valiatedData = $request->validated();

        if(!Auth::attempt([
            'email' => $valiatedData['email'],
            'password' => $valiatedData['password']
        ])){
            return response()->json([
                'message' => 'invalid credentials!'
            ],422 );
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'login realized with success!',
            'user' => $user,
            'auth-token' => $token,
        ]);
    }

    public function logout (): JsonResponse
    {
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'logout realized with success'
        ]);
    }
}
