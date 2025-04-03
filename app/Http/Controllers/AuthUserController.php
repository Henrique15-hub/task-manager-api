<?php

namespace App\Http\Controllers;

use Str;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthUserRequest;

class AuthUserController extends Controller
{
    public function login (AuthUserRequest $request){
        $validatedData = $request->validated();

        if (Auth::attempt(['email' => $validatedData['email'],
         'password' => $validatedData['password']])){

            $user = Auth::User();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login realized with sucess',
                'user' => $user,
                'token' => $token
            ], 200);
         }


         return response()->json([
            'message' => 'Invalid information!'
         ]);
    }



    public function register (){

        return response()->json(route('store'));
    }

    public function logout (Request $request){
            $user = User::find(Auth::id());
            $user->tokens()->delete();

        return response()->json([
            'message' => 'logout realized with sucess!',

        ]);
    }
}

