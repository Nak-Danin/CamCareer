<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company_name = fake()->company();
        $clean_name = strtolower(preg_replace('/[^A-Za-z0-9-,]/', '', $company_name));
        $tld = fake()->randomElement(['org', 'com', 'io', 'plc']);
        $industry = ['Technology', 'Sale', 'Banking & Finance', 'Education', 'Sport', 'Service'];
        return [
            'user_id' => User::factory()->employer(),
            'company_name' => $company_name,
            'slug' => Company::generateUniqueSlug($company_name),
            'website' => $clean_name . "@example." . $tld,
            'industry' => fake()->randomElement($industry),
            'logo_url' => fake()->imageUrl(200, 200, 'business'),
            'location' => fake()->randomElement(config('cambodia.locations')),
            'description' => fake()->randomElement(config('bio.companies'))
        ];
    }
}
