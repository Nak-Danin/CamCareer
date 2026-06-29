<?php

namespace Database\Factories;

use App\Models\CareerSeeker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CareerSeeker>
 */
class CareerSeekerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->phoneNumber(),
            'resume_url' => fake()->url(),
            'bio' => fake()->paragraph(3),
            'profile' => null,
        ];
    }
}
