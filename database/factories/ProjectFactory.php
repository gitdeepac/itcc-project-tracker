<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [ 
            'project_name'        => fake()->bs(), // generates realistic project names // bs - business-sounding
            'client_name' => fake()->company(), // generates realistic client names
			'deadline'    => fake()->dateTimeBetween('+1 month', '+6 months'),
            'status'      => fake()->randomElement(['active', 'on_hold', 'completed']),
        ];
    }
}
