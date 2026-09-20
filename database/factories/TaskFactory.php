<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'title'          => fake()->sentence(4),
			'assignee'       => fake()->name(),
			'estimate_hours' => fake()->randomFloat(2, 0.5, 8),
			'status'         => fake()->randomElement(['todo', 'in_progress', 'done']),
			'due_date'       => fake()->dateTimeBetween('now', '+1 month'),
		];
	}
}
