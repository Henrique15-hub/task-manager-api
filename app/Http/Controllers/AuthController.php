<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\AuthLogin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthLogin $request): JsonResponse
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (! $user or ! Hash::check($validatedData['password'], $user->password)) {
            return response()->json([
                'message' => 'invalid credentials!',
            ], 422);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'login realized with success!',
            'user' => $user,
            'auth-token' => $token,
        ]);
    }

    public function logout(): JsonResponse
    {
        $user = auth('sanctum')->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'logout realized with success',
        ]);
    }
}
