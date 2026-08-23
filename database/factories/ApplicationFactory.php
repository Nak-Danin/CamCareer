<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Career;
use App\Models\CareerSeeker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'career_id' => Career::factory(),
            'seeker_id' => CareerSeeker::factory(),
            'status' => fake()->randomElement(['applied', 'shortlisted', 'interview']),
        ];
    }
}
