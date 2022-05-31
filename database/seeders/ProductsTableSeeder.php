<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create([
            'product_type_id' => 1,
            'name' => 'Free Career Advice',
            'keyword'  =>   'free-career-advice',
            'description'   =>  '',
            'status'   =>  'active',
        ]);

        App\Product::create([
            'product_type_id' => 1,
            'name' => 'Private Career Coaching',
            'keyword'  =>   'private-career-coaching',
            'description'   =>  '',
            'status'   =>  'active',
        ]);
    }
}
