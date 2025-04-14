<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'invalid data',
            ]);
        }
        $user = User::create($validatedData);

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'message' => 'user not found',
            ], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        if (! $validatedData) {
            return response()->json([
                'message' => 'invalid data',
            ]);
        }
        $user = User::find($id);
        if (! $user) {
            return response()->json([
                'message' => 'user not found',
            ], 404);
        }

        $user->update($validatedData);

        return response()->json($user);
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
        $user->delete();

        return response()->json([
            'message' => 'user deleted.',
        ]);
    }
}
