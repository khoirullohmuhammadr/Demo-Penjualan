<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role' => 'Super Admin',
        ]);
        Role::create([
            'role' => 'Admin Create',
        ]);
        Role::create([
            'role' => 'Admin View',
        ]);
        Role::create([
            'role' => 'Sales',
        ]);
    }
}
