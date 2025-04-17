<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserUpdate;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\User\UserStore;


class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

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
     * Display the specified resource.
     */
    public function show(int $id):JsonResponse
    {
        $user = User::findorFail($id);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdate $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        $user = User::findOrFail($id);

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
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'user deleted with success'
        ]);
    }
}
