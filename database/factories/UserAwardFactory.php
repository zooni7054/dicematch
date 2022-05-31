<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserAwardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'issue_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'education_institute_id' => $this->faker->numberBetween($min = 1, $max = 5),
            'title' => $this->faker->text($maxNbChars = 20),
            'issuer' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
