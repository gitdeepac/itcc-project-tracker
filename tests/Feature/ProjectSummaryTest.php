<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectSummaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_summary_endpoint_returns_correct_values(): void
    {
        $user    = User::factory()->create();
        $token   = $user->createToken('test')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $project = Project::factory()->create([
            'status'   => 'active',
            'deadline' => now()->addDays(30),
        ]);

        Task::factory()->create([
            'project_id'     => $project->id,
            'status'         => 'done',
            'estimate_hours' => 4,
            'due_date'       => now()->addDays(5),
        ]);
        Task::factory()->create([
            'project_id'     => $project->id,
            'status'         => 'todo',
            'estimate_hours' => 6,
            'due_date'       => now()->subDays(2),
        ]);

        $this->getJson("/api/projects/{$project->id}/summary", $headers)
            ->assertOk()
            ->assertJson([
                'total_tasks'           => 2,
                'done_tasks'            => 1,
                'pending_tasks'         => 1,
                'total_estimated_hours' => 10.0,
                'hours_remaining'       => 6.0,
                'overdue_tasks'         => 1,
                'is_project_overdue'    => false,
            ]);
    }
}