<?php

namespace Database\Factories;

use App\Models\FormData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormData>
 */
class FormDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'dob' => $this->faker->date,
            'frequency' => $this->faker->randomElement(['weekly', 'monthly', 'yearly']),
            'daily_frequency' => $this->faker->randomElement(['1_2', '3_4', '5']),
        ];
    }
}
