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
        $industry = ['Technology', 'Sale', 'Banking&Finance', 'Education', 'Sport', 'Service'];
        $realisticDescriptions = [
            "We are a fast-growing tech startup focused on building the next generation of remote collaboration tools. We value inclusivity, innovation, and asynchronous work.",
            "A leading digital marketing agency dedicated to helping small businesses scale their online presence. Founded in 2018, we manage over 200 global clients.",
            "We build sustainable fintech solutions to make banking accessible to everyone. Our team is fully remote and distributed across twelve different time zones.",
            "An established e-commerce platform specializing in eco-friendly consumer goods. We believe in green logistics and ethical sourcing for all of our products."
        ];
        return [
            'user_id' => User::factory()->employer(),
            'company_name' => $company_name,
            'website' => $clean_name . "@example." . $tld,
            'industry' => fake()->randomElement($industry),
            'logo_url' => fake()->imageUrl(200, 200, 'business'),
            'location' => fake()->city(),
            'description' => fake()->randomElement($realisticDescriptions)
        ];
    }
}
