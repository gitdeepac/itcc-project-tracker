<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	/** @use HasFactory<\Database\Factories\ProjectFactory> */
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
		'client_name',
		'deadline',
		'status',
	];

	protected $casts = [
		'deadline' => 'date',
	];

	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
}
