<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_id' => $this->faker->numberBetween($min = 1, $max = 30),
            'employment_type_id' => $this->faker->numberBetween($min = 1, $max = 3),
            'start_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'end_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'title' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
