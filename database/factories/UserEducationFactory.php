<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserEducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'education_institute_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'education_field_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'education_level_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'start_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'end_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'qualification_name' => $this->faker->text($maxNbChars = 20),
            'marks' => $this->faker->numberBetween($min = 2, $max = 5),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
