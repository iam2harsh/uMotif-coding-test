<?php

namespace Database\Factories;

use App\Models\FormData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'form_data_id' => FormData::factory()->create()->id,
            'result' => $this->faker->text(20),
        ];
    }
}
