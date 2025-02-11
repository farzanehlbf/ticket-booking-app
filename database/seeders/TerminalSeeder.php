<?php

namespace Database\Seeders;

use App\Models\Terminal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Terminal::factory(10)->create();
    }
}
