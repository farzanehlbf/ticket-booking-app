<?php

namespace Database\Seeders;

use App\Models\TransportType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        TransportType::create(['name' => 'Bus']);
        TransportType::create(['name' => 'Plane']);
        TransportType::create(['name' => 'Ship']);

        $this->call([

            DestinationSeeder::class,
            OriginSeeder::class,
           // TerminalSeeder::class,
           // TransportTypeSeeder::class,
            BusTerminalSeeder::class,
            TripSeeder::class,
            BusTripSeeder::class,


        ]);
    }
}
