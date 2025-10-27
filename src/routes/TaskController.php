<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /api/tasks
    public function index()
    {
        return response()->json(Task::all(), 200);
    }

    // POST /api/tasks
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,in-progress,completed',
            'due_date' => 'nullable|date'
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    // GET /api/tasks/{id}
    public function show($id)
    {
        $task = Task::find($id);
        return $task ? response()->json($task) : response()->json(['message' => 'Task not found'], 404);
    }

    // PUT /api/tasks/{id}
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|string|in:pending,in-progress,completed',
            'due_date' => 'nullable|date'
        ]);

        $task->update($validated);
        return response()->json($task, 200);
    }

    // DELETE /api/tasks/{id}
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
