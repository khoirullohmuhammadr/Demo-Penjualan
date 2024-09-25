<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'The One Above All',
            'image' => 'image.png',
            'email' => 'toaa@gmail.com',
            'password' => Hash::make('password123'),
            'birthday'=>'2006/10/02',
            'cities_id' => '1',
            'role_id' => '1',
        ]);
    }
}
