<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserCertificationFactory extends Factory
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
            'expiry_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'title' => $this->faker->text($maxNbChars = 20),
            'organization' => $this->faker->text($maxNbChars = 20),
            'credential_id' => $this->faker->text($maxNbChars = 20),
            'credential_url' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
