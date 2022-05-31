<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'career_track_id' => $this->faker->numberBetween($min = 3, $max = 8),
            'name' => $this->faker->word(),
            'skill_type' => $this->faker->randomElement(['Core', 'Soft']),
        ];
    }
}
