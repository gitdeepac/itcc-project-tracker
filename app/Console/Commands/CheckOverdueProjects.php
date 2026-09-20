<?php

namespace App\Console\Commands;

use App\Jobs\LogOverdueProject;
use App\Models\Project;
use Illuminate\Console\Command;

class CheckOverdueProjects extends Command
{
    protected $signature   = 'projects:check-overdue';
    protected $description = 'Dispatch a log job for every overdue project';

    public function handle(): void
    {
        $overdue = Project::where('deadline', '<', now())
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($overdue as $project) {
            LogOverdueProject::dispatch($project);
            $this->info("Queued: {$project->project_name}");
        }

        $this->info("Done — {$overdue->count()} overdue project(s) queued.");
    }
}