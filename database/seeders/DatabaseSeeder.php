<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Career;
use App\Models\CareerSeeker;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(20)->create() automatically;
        $seekers = CareerSeeker::factory(20)->create();
        $companies = Company::factory(5)->create();
        $companies->each(function ($company) use ($seekers) {
            $careers = Career::factory(3)->create(['company_id' => $company->company_id]);
            $careers->each(function ($career) use ($seekers) {
                $randomSeekers = $seekers->random(rand(2, 5));
                foreach ($randomSeekers as $seeker) {
                    Application::factory()->create([
                        'career_id' => $career->career_id,
                        'seeker_id' => $seeker->seeker_id
                    ]);
                }
            });
        });
    }
}
