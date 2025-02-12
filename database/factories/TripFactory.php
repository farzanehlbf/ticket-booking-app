<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\Origin;
use App\Models\Terminal;
use App\Models\TransportType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // اطمینان از ایجاد رکورد 'Bus' در صورت عدم وجود
        $busTransportType = TransportType::firstOrCreate(['name' => 'Bus']);

        return [
            'origin_id' => Origin::factory(),
            'destination_id' => Destination::factory(),
            'terminal_id' => Terminal::factory(),
            'transport_type_id' => $busTransportType->id, // استفاده از شناسه رکورد
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
