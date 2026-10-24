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
            'title' => fake()->jobTitle(),
            'location' => fake()->randomElement(config('cambodia.locations')),
            'phone' => fake()->phoneNumber(),
            'bio' => fake()->randomElement(config('bio.seekers')),
            'profile' => null,
        ];
    }
}
