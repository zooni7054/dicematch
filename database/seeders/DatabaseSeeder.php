<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserAward;
use App\Models\UserCertification;
use App\Models\UserCourse;
use App\Models\UserEducation;
use App\Models\UserExperience;
use App\Models\UserInterest;
use App\Models\UserPatent;
use App\Models\UserPublication;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            LookupsSeeder::class,
            // CountriesSeeder::class,
            // StatesSeeder::class,
            // CitiesSeeder::class,
        ]);

        Company::factory(100)->create();
        Skill::factory(30)->create();

        $users = User::factory(50)
            ->has(UserEducation::factory()->count(3), 'education')
            ->has(UserExperience::factory()->count(3), 'experiences')
            ->has(UserCourse::factory()->count(3), 'courses')
            ->has(UserCertification::factory()->count(3), 'certifications')
            ->has(UserAward::factory()->count(2), 'awards')
            ->has(UserPublication::factory()->count(1), 'publications')
            ->has(UserPatent::factory()->count(1), 'patents')
            ->has(UserInterest::factory()->count(5), 'interests')
            ->hasAttached(
                Skill::factory()->count(3),
                ['level' => '50']
            )
            ->create();

        // \App\Models\User::factory(10)->create();
    }
}
