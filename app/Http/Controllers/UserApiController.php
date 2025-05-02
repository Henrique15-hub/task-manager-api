<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStore;
use App\Http\Requests\User\UserUpdate;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserApiController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStore $request): JsonResponse
    {
        $validatedData = $request->validated();
        $user = User::create($validatedData);

        return response()->json([
            'message' => 'user created with success!',
            'user' => $user->fresh(),
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdate $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'message' => 'user not found',
            ], 404);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'user updated with sucess',
            'user' => $user->fresh(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'message' => 'user not found',
            ], 404);
        }

        $user->tokens->delete();
        $user->delete();

        return response()->json([
            'message' => 'user deleted with success',
        ]);
    }
}
