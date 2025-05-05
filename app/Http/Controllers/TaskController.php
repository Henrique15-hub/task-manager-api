<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\storeTask;
use App\Http\Requests\Task\updateTask;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        return response()->json([
            'message' => 'showing all the tasks',
            'tasks' => $tasks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeTask $request): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth('sanctum')->id();
        $task = Task::create($validatedData);

        return response()->json([
            'message' => 'Task created with success',
            'task' => $task->fresh(),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (! $task or $task->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        }

        return response()->json([
            'message' => 'task found with success',
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateTask $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();
        $task = Task::find($id);

        if (! $task or $task->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        }

        $task->update($validatedData);

        return response()->json([
            'message' => 'task updated with success',
            'task' => $task->fresh(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (! $task or $task->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'task not found',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'task deleted with success',
        ]);
    }
}
