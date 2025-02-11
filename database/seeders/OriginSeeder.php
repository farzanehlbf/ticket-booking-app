<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Origin;
use Faker\Factory as Faker;

class OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Origin::create([
                'name' => $faker->city,
                'city_code' => $faker->unique()->numerify('####'),
            ]);
        }
    }
}
