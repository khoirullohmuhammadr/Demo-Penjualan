<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'city_name' => 'Washington',
        ]);
        City::create([
            'city_name' => 'New York',
        ]);
        City::create([
            'city_name' => 'Miami',
        ]);
        City::create([
            'city_name' => 'California',
        ]);
    }
}
