<?php

namespace Database\Seeders;

use App\Models\BusTrip;
use Illuminate\Database\Seeder;

class BusTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusTrip::factory(10)->create();
    }
}
