<?php

namespace Database\Seeders;

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
            LookupsSeeder::class,
            CountriesSeeder::class,
            StatesSeeder::class,
            // CitiesSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();
    }
}
