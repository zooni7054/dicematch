<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'end_date' => $this->faker->date($format = 'd-m-Y', $max = 'now'),
            'course_name' => $this->faker->text($maxNbChars = 20),
            'institute_name' => $this->faker->text($maxNbChars = 20),
            'description' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
