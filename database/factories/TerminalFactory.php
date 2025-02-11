<?php

namespace Database\Factories;

use App\Models\Origin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Terminal>
 */
class TerminalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origin_id' => Origin::factory(),
            'name' => $this->faker->city,
            'terminal_code' => $this->faker->unique()->bothify('???-###'),
        ];

    }
}
