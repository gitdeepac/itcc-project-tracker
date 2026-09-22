<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class taskTest extends TestCase
{
    use RefreshDatabase;

	public function test_cannot_view_task_of_projectB_from_projectA(): void
    {
        $user    = User::factory()->create();
        $token   = $user->createToken('test')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $projectA = Project::factory()->create([
            'status'   => 'active',
            'deadline' => now()->addDays(30),
        ]);
        $projectB = Project::factory()->create([
            'status'   => 'active',
            'deadline' => now()->addDays(30),
        ]);

        
        $taskB = Task::factory()->create([
            'project_id'     => $projectB->id,
            'status'         => 'todo',
            'estimate_hours' => 6,
            'due_date'       => now()->subDays(2),
        ]);

        $this->getJson("/api/projects/{$projectA->id}/tasks/{$taskB->id}", $headers)
            ->assertNotFound();
    }

	public function test_cannot_update_task_via_wrong_project(): void
    {
		$user    = User::factory()->create();
        $token   = $user->createToken('test')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $projectA = Project::factory()->create([
            'status'   => 'active',
            'deadline' => now()->addDays(30),
        ]);
        $projectB = Project::factory()->create([
            'status'   => 'active',
            'deadline' => now()->addDays(30),
        ]);

        $task     = Task::factory()->create(['project_id' => $projectB->id]);

        $this->putJson("/api/projects/{$projectA->id}/tasks/{$task->id}", [
            'status' => 'done',
        ], $headers)->assertNotFound();
    }

	public function test_cannot_delete_task_via_wrong_project(): void
    {
        $user    = User::factory()->create();
        $token   = $user->createToken('test')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $projectA = Project::factory()->create([
            'status'   => 'active',
            'deadline' => now()->addDays(30),
        ]);
        $projectB = Project::factory()->create([
            'status'   => 'active',
            'deadline' => now()->addDays(30),
        ]);

		$taskB = Task::factory()->create([
            'project_id'     => $projectB->id,
            'status'         => 'todo',
            'estimate_hours' => 6,
            'due_date'       => now()->subDays(2),
        ]);

        $this->deleteJson("/api/projects/{$projectA->id}/tasks/{$taskB->id}", [], $headers)
            ->assertNotFound();
    }
	
}
