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
        return [
            'origin_id' => Origin::factory(),
            'destination_id' => Destination::factory(),
            'terminal_id' => Terminal::factory(),
            'transport_type_id' => TransportType::where('name', 'Bus')->first()->id,
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
