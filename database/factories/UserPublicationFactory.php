<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserPublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'publication_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'title' => $this->faker->text($maxNbChars = 20),
            'publisher' => $this->faker->text($maxNbChars = 20),
            'publication_url' => $this->faker->text($maxNbChars = 20),
            'research_area' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
