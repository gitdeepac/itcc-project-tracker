<?php

namespace App\Jobs;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LogOverdueProject implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Project $project) {}

    public function handle(): void
    {
        Log::warning('Project is overdue', [
            'project_id'   => $this->project->id,
            'project_name' => $this->project->project_name,
            'client_name'  => $this->project->client_name,
            'deadline'     => $this->project->deadline->format('Y-m-d'),
            'status'       => $this->project->status,
            'checked_at'   => now()->toDateTimeString(),
        ]);
    }
}