<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\Origin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusTerminal>
 */
class BusTerminalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origin_id' => Origin::inRandomOrder()->first()->id ?? null,  // مبدا تصادفی
            'destination_id' => Destination::inRandomOrder()->first()->id ?? null,  // مقصد تصادفی
            'name' => $this->faker->company,  // نام ترمینال
            'terminal_code' => $this->faker->unique()->bothify('???-#####'),  // کد ترمینال
        ];
    }
}
