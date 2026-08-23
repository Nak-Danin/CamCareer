<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Career;
use App\Models\CareerSeeker;
use App\Models\Category;
use App\Models\Company;
use App\Models\Interview;
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
        $this->call([CareerSeekerSeeder::class]);
        $this->call([CompanySeeder::class]);
        $this->call([CategorySeeder::class]);
        $seekers = CareerSeeker::all();
        $companies = Company::all();
        $categories = Category::all();
        $applications = [];
        $companies->each(function ($company) use ($seekers, $categories, &$applications) {
            $careers = Career::factory(3)->create(['company_id' => $company->company_id, 'category_id' => $categories->random()->category_id]);
            $careers->each(function ($career) use ($seekers, &$applications) {
                $randomSeekers = $seekers->random(rand(2, 5));
                foreach ($randomSeekers as $seeker) {
                    $applications[] = Application::factory()->create([
                        'career_id' => $career->career_id,
                        'seeker_id' => $seeker->seeker_id
                    ]);
                }
            });
        });
        foreach ($applications as $application) {
            if ($application->status === 'interview') {
                Interview::factory()->create(['application_id' => $application->id]);
            }
        }
    }
}
