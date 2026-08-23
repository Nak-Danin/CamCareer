<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Career>
 */
class CareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->jobTitle();
        return [
            'company_id' => Company::factory(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(2, 100),
            'description' => fake()->paragraph(3, true),

            // Storing as a proper PHP array for JSON columns
            'responsibilities' => [
                'Design blueprints for planning and implementation',
                'Handle daily operations and sprint tasks',
                'Collaborate with cross-functional teams',
                'Mentor junior and mid-level employees'
            ],
            'benefits' => [
                'Premium Health Coverage',
                'Hybrid Work Model',
                'Equity & Bonus options',
                'Wellness Stipend'
            ],
            'requirements' => [
                '2+ years of experience in a related field',
                'A portfolio demonstrating expertise in the field',
                'Proficiency in English (both speaking and writing)',
                'Great communication skills with the ability to work under pressure'
            ],

            'location' => fake()->randomElement(['Remote', 'Hybrid', fake()->city()]),
            'salary_range' => fake()->randomElement(['Negotiable', '400 - 600', '800 - 1200']),
            'career_type' => fake()->randomElement(['full-time', 'part-time', 'internship', 'contract']),
            'status' => fake()->randomElement(['available', 'available', 'available', 'unavailable']),
        ];
    }
}
