<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$projects = Project::withCount('tasks')->latest()->get();

		return ProjectResource::collection($projects);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /api/projects
	 */
	public function store(ProjectRequest $request)
	{
		$project = Project::create($request->validated());
		return new ProjectResource($project);
	}

	/**
	 * Display the specified resource.
	 * GET /api/projects/{project}
	 */
	public function show(Project $project)
	{
		return new ProjectResource($project->load('tasks'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /api/projects/{project}
	 */
	public function update(ProjectRequest $request, Project $project)
	{
		$project->update($request->validated());

		return new ProjectResource($project);
	}

	/**
	 * Project summary.
	 * GET /api/projects/{project}/summary
	 */
	public function summary(Project $project)
	{
		$tasks = $project->tasks;

		$totalTasks        = $tasks->count();
		$doneTasks         = $tasks->where('status', 'done')->count();
		$totalHours        = $tasks->sum('estimate_hours');
		$hoursRemaining    = $tasks->where('status', '!=', 'done')->sum('estimate_hours');
		$overdueTasks      = $tasks->where('status', '!=', 'done')
			->where('due_date', '<', now()->toDateString())
			->count();
		$isProjectOverdue  = $project->deadline->isPast();

		return response()->json([
			'project'           => $project->name,
			'total_tasks'       => $totalTasks,
			'done_tasks'        => $doneTasks,
			'pending_tasks'     => $totalTasks - $doneTasks,
			'total_estimated_hours' => $totalHours,
			'hours_remaining'   => $hoursRemaining,
			'overdue_tasks'     => $overdueTasks,
			'is_project_overdue' => $isProjectOverdue,
			'deadline'          => $project->deadline->format('Y-m-d'),
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Project $project)
	{
		$project->delete();
		return response()->json([
			'message' => 'Project deleted successfully',
		]);
	}
}
