<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' =>fake()->unique()->numberBetween(22999, 29999),
            'first_name' =>fake()->firstName,
            'middle_name' =>fake()->lastName,
            'last_name' =>fake()->lastName,
            'program_id' =>fake()->numberBetween(1, 3),
            'year_level' =>fake()->numberBetween(1, 4),
            'email' =>fake()->unique()->safeEmail,
            'phone_number' =>fake()->phoneNumber,
            'address' =>fake()->address,
        ];
    }
}
