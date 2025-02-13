<?php

namespace Database\Factories;

use App\Models\Destination;
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
        $isOrigin = $this->faker->boolean;  // انتخاب مبدا یا مقصد به صورت تصادفی

        return [
            'origin_id' => $isOrigin ? Origin::factory() : null,  // اگر مبدا باشد، origin_id را پر می‌کنیم
            'destination_id' => $isOrigin ? null : Destination::factory(),  // اگر مقصد باشد، destination_id را پر می‌کنیم
            'name' => $this->faker->city,
            'terminal_code' => $this->faker->unique()->bothify('???-###'),
        ];

    }
}
