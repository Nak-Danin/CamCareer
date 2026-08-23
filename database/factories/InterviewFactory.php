<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Interview>
 */
class InterviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'application_id' => Application::factory(),
            'interview_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'interview_time' => fake()->randomElement(['10:00', '08:00', '09:00', '14:00', '15:00']),
            'location' => fake()->randomElement(['Wing Tower, 10th floor', 'ChipMong Tower, 5th floor', 'Olympia Tower, 6th floor']),
            'meeting_link' => null,
            'status' => fake()->randomElement(['scheduled']),
        ];
    }
}
