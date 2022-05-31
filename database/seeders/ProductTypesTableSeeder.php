<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ProductType::create([
            'name'     => 'Career Coaching',
            'status'   =>  'active',
        ]);
    }
}
