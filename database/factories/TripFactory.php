<?php

namespace Database\Factories;

use App\Models\BusTerminal;
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
            'origin_id' => BusTerminal::inRandomOrder()->first()->origin_id ?? null,  // مبدا تصادفی از ترمینال
            'destination_id' => BusTerminal::inRandomOrder()->first()->destination_id ?? null,  // مقصد تصادفی از ترمینال
            'transport_type_id' => TransportType::inRandomOrder()->first()->id,  // نوع حمل‌ونقل تصادفی
            'origin_terminalable_id' => BusTerminal::inRandomOrder()->first()->id,  // شناسه ترمینال مبدا
            'origin_terminalable_type' => BusTerminal::class,  // نوع ترمینال مبدا
            'destination_terminalable_id' => BusTerminal::inRandomOrder()->first()->id,  // شناسه ترمینال مقصد
            'destination_terminalable_type' => BusTerminal::class,  // نوع ترمینال مقصد
            'date' => $this->faker->dateTimeBetween('now', '+1 month'),  // تاریخ سفر
        ];
    }

}
