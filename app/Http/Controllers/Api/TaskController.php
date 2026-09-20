<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskMarkedDone;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /api/projects/{project}/tasks
    public function index(Project $project)
    {
        $tasks = $project->tasks()->latest()->get();

        return TaskResource::collection($tasks);
    }

    // POST /api/projects/{project}/tasks
    public function store(TaskRequest $request, Project $project)
    {
        $task = $project->tasks()->create($request->validated());
        return new TaskResource($task);
    }

    // GET /api/projects/{project}/tasks/{task}
    public function show(Project $project, Task $task)
    {
        return new TaskResource($task);
    }

    // PUT /api/projects/{project}/tasks/{task}
    public function update(TaskRequest $request, Project $project, Task $task)
    {
        $task->update($request->validated());
		$task->refresh();
		
		if ($task->status === 'done') {
            event(new TaskMarkedDone($task));
        }
        return new TaskResource($task);
    }

    // DELETE /api/projects/{project}/tasks/{task}
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }
}