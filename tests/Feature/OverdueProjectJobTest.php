<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Jobs\LogOverdueProject;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;

class OverdueProjectJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_overdue_project_job_is_dispatched(): void
    {
        Bus::fake();

        $project = Project::factory()->create([
            'deadline' => now()->subDays(3),
            'status'   => 'active',
        ]);

        $this->artisan('projects:check-overdue')->assertSuccessful();

        Bus::assertDispatched(LogOverdueProject::class, function ($job) use ($project) {
            return $job->project->id === $project->id;
        });
    }
}