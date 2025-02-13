<?php

namespace Database\Seeders;

use App\Models\BusTerminal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusTerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BusTerminal::factory()->count(3)->create();
    }
}
