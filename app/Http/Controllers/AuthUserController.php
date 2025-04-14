<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    public function login(AuthUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        if (! $validatedData) {
            return response()->json([
                'message' => 'invalid data',
            ]);
        }
        if (Auth::attempt(['email' => $validatedData['email'],
            'password' => $validatedData['password']])) {
            $user = Auth::User();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login realized with sucess',
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json([
            'message' => 'Invalid data!',
        ], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = User::find(Auth::id());
        if (! $user) {
            return response()->json([
                'message' => 'user not found',
            ], 404);
        }
        $user->tokens()->delete();

        return response()->json([
            'message' => 'logout realized with sucess!',
        ]);
    }
}
