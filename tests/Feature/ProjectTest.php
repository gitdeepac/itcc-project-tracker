<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;

class ProjectTest extends TestCase
{

	use RefreshDatabase;
	/**
	 * A basic feature test example.
	 */
	public function test_project_endpoint_corrently_return_project_name_instead_name(): void
	{

		$user    = User::factory()->create();
		$token   = $user->createToken('test')->plainTextToken;
		$headers = ['Authorization' => "Bearer $token"];

		$project = Project::factory()->create([
			'status'   => 'active',
			'project_name' => "itcc-project-tracker-by-deepak",
			'deadline' => now()->addDays(30),
		]);

		$response = $this->getJson('/api/projects', $headers)->assertOk();

		$response->assertJsonFragment(['project_name' => 'itcc-project-tracker-by-deepak']); // check positive
		$response->assertJsonMissing(['name' => 'itcc-project-tracker-by-deepak']); // check negative
	}

	public function test_create_returns_project_name(): void
    {
		$user    = User::factory()->create();
		$token   = $user->createToken('test')->plainTextToken;
		$headers = ['Authorization' => "Bearer $token"];

        $response = $this->postJson('/api/projects', [
            'project_name' => 'Test Project',
            'client_name'  => 'Test Client',
            'deadline'     => now()->addDays(30)->format('Y-m-d'),
            'status'       => 'active',
        ], $headers);

        $response->assertCreated()
            ->assertJsonFragment(['project_name' => 'Test Project'])
            ->assertJsonMissing(['name' => 'Test Project']);
    }

	public function test_show_returns_project_name(): void
    {
		$user    = User::factory()->create();
		$token   = $user->createToken('test')->plainTextToken;
		$headers = ['Authorization' => "Bearer $token"];

        $project = Project::factory()->create(['project_name' => 'Test Project']);

        $this->getJson("/api/projects/{$project->id}", $headers)
            ->assertOk()
            ->assertJsonFragment(['project_name' => 'Test Project'])
            ->assertJsonMissing(['name' => 'Test Project']);
    }

	public function test_update_returns_project_name(): void
    {
		$user    = User::factory()->create();
		$token   = $user->createToken('test')->plainTextToken;
		$headers = ['Authorization' => "Bearer $token"];

        $project = Project::factory()->create(['project_name' => 'Old Name']);

        $this->putJson("/api/projects/{$project->id}", [
            'project_name' => 'Updated Name',
            'client_name'  => $project->client_name,
            'deadline'     => now()->addDays(30)->format('Y-m-d'),
            'status'       => 'active',
        ], $headers)
            ->assertOk()
            ->assertJsonFragment(['project_name' => 'Updated Name'])
            ->assertJsonMissing(['name' => 'Updated Name']);
    }


}
