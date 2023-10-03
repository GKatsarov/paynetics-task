<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve a list of projects
        $tasks = Task::paginate(3); // Adjust the pagination as needed
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        // Create a new project

        Task::create($request->validated());
        return response()->success(['message' => 'Task created successfully.','original_status'=>'201']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve a single task
        $task = Task::find($id);

        if(!$task){
            return response()->error(['error' => 'Task not found.','original_status'=>'404']);
        }
        return response()->success(['task' => $task,'original_status'=>'200']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        // Update a project
        $task = Task::find($id);
        if(!$task){
            return response()->error(['error' => 'Task not found.','original_status'=>'404']);
        }

        $task->update($request->validated());
        return response()->success(['message' => 'Task updated successfully.','original_status'=>'200']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete a task
        $task = Task::find($id);
        if(!$task){
            return response()->error(['error' => 'Task not found.','original_status'=>'404']);
        }

        $task->delete();
        return response()->success(['message' => 'Task deleted successfully.','original_status'=>'200']);
    }
}
