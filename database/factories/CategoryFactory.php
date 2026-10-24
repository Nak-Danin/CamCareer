<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Healthcare',
            'Finance',
            'Technology',
            'Marketing',
            'Education',
            'Hospitality',
            'Logistics',
            'Real Estate',
            'Customer Service',
            'Human Resources',
            'Design',
            'Business Development',
        ];
        return [
            'category_name' => fake()->unique()->randomElement($categories),
        ];
    }
}
