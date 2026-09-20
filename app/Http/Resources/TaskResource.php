<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'project_id'     => $this->project_id,
            'title'          => $this->title,
            'assignee'       => $this->assignee,
            'estimate_hours' => $this->estimate_hours,
            'status'         => $this->status,
            'due_date'       => $this->due_date->format('Y-m-d'),
            'completed_at'   => $this->completed_at?->format('Y-m-d H:i:s'),
            'created_at'     => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
