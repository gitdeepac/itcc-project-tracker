<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_project_fails_validation_when_required_fields_are_missing(): void
    {
        $user    = User::factory()->create();
        $token   = $user->createToken('test')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $this->postJson('/api/projects', [], $headers)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'client_name', 'deadline', 'status']);
    }
}