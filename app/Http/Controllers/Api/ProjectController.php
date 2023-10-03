<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve a list of projects
        $projects = Project::paginate(3); // Adjust the pagination as needed
        return view('projects.index', compact('projects'));
    }

    public function view(string $id)
    {
        // Retrieve a list of projects
        // Retrieve a single project
        $project = Project::find($id);
        $tasks = $project->tasks()->paginate(3); // Adjust the pagination as needed

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        // Create a new project

        Project::create($request->validated());
        return response()->success(['message' => 'Project created successfully.','original_status'=>'201']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve a single project
        $project = Project::find($id);

        if(!$project){
            return response()->error(['error' => 'Project not found.','original_status'=>'404']);
        }
        return response()->success(['project' => $project,'original_status'=>'200']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id)
    {
        // Update a project
        $project = Project::find($id);
        if(!$project){
            return response()->error(['error' => 'Project not found.','original_status'=>'404']);
        }

        $project->update($request->validated());
        return response()->success(['message' => 'Project updated successfully.','original_status'=>'200']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete a project
        $project = Project::find($id);
        if(!$project){
            return response()->error(['error' => 'Project not found.','original_status'=>'404']);
        }
        $project->delete();
        return response()->success(['message' => 'Project deleted successfully.','original_status'=>'200']);
    }
}
