<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $tasks = Task::where('user_id', $userId)->get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TasksRequest $request)
    {


        $task = Task::create([
            'name' => $request->name,
            'hours' => $request->hours,
            'user_id' => Auth::id()
        ]);


        return response()->json([
            'message' => 'success',
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TasksRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $task = Task::find($id);
        $task->update($validatedData);


        return response()->json([
            'message' => 'updated with success',
            'task' =>$task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json([
            'message' => 'deleted with success'
        ]);
    }
}
