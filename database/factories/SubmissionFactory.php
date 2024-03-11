<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'address' => fake()->address(),
            'apartment_no' => fake()->postcode(),
            'city' => fake()->city(),
            'state' => fake()->streetAddress(),
            'zip_code' => fake()->postcode(),
        ];
    }
}
