<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $userId = Auth::id();
        $tasks = Task::where('user_id', $userId)->get();

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TasksRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        if (! $validatedData) {
            return response()->json([
                'message' => 'data invalid',
            ]);
        }
        $task = Task::create([
            'name' => $validatedData['name'],
            'hours' => $validatedData['hours'],
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'task created with success',
            'task' => $task,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TasksRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        if (! $validatedData) {
            return response()->json([
                'message' => 'invalid data',
            ]);
        }
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        }
        $task->update($validatedData);

        return response()->json([
            'message' => 'updated with success',
            'task' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        }
        $task->delete();

        return response()->json([
            'message' => 'deleted with success',
        ]);
    }
}
