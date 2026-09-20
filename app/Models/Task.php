<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, SoftDeletes;

	protected $fillable = [
        'project_id',
        'title',
        'assignee',
        'estimate_hours',
        'status',
        'due_date'
    ];

	protected $casts = [
        'due_date'      => 'date',
        'estimate_hours' => 'decimal:2',
    ];

	// Relationship
    public function project()
    {
        return $this->belongsTo(Project::class);
 	}
}
