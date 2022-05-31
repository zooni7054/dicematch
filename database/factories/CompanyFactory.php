<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'industry_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'city_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'name' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
