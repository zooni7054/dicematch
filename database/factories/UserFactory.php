<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('test123'),
            'remember_token' => Str::random(10),
            'phone' => $this->faker->phoneNumber(),
            'cnic' => $this->faker->userName(),
            'address' => $this->faker->streetName(),
            'city_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'profile_headline' => $this->faker->userName(),
            'career_track_id' => $this->faker->numberBetween($min = 3, $max = 8),
            'about' => $this->faker->text($maxNbChars = 500)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
