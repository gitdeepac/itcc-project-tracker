<?php

namespace App\Listeners;

use App\Events\TaskMarkedDone;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AutoCompleteProject
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskMarkedDone $event): void
    {
        $project = $event->task->project;

        $totalTasks = $project->tasks()->count();
        $doneTasks  = $project->tasks()->where('status', 'done')->count();

        if ($totalTasks > 0 && $totalTasks === $doneTasks) {
            $project->update(['status' => 'completed']);
        }
    }
}
