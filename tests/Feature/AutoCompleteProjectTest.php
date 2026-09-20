<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutoCompleteProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_status_becomes_completed_when_all_tasks_are_done(): void
    {
        $user    = User::factory()->create();
        $token   = $user->createToken('test')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $project = Project::factory()->create(['status' => 'active']);
        Task::factory()->create(['project_id' => $project->id, 'status' => 'done']);
        $task2 = Task::factory()->create(['project_id' => $project->id, 'status' => 'todo']);

        $this->putJson(
            "/api/projects/{$project->id}/tasks/{$task2->id}",
            ['status' => 'done'],
            $headers
        )->assertOk();

        $this->assertDatabaseHas('projects', [
            'id'     => $project->id,
            'status' => 'completed',
        ]);
    }
}