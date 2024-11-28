<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculty>
 */
class FacultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'faculty_id' => fake()->unique()->randomNumber(4),
            'first_name' => fake()->firstName,
            'middle_name' => fake()->lastName,
            'last_name' => fake()->lastName,
            'email' => fake()->unique()->safeEmail,
            'phone_number' => fake()->phoneNumber,
            'address' => fake()->address,
        ];
    }
}
