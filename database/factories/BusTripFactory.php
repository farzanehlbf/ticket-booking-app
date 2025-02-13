<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\Origin;
use App\Models\Terminal;
use App\Models\TransportType;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusTrip>
 */
class BusTripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trip_id' => Trip::factory(), // ایجاد یک سفر مرتبط
            'bus_number' => $this->faker->unique()->numberBetween(100, 999),
            'bus_company' => $this->faker->company(),
            'seat_count' => $this->faker->numberBetween(20, 50),
        ];

    }
}
