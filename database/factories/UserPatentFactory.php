<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserPatentFactory extends Factory
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
            'title' => $this->faker->text($maxNbChars = 20),
            'application_number' => $this->faker->text($maxNbChars = 20),
            'patent_url' => $this->faker->text($maxNbChars = 20),
            'patent_office' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
