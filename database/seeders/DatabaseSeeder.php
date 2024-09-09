<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Role::factory()->create([
        //     'name' => 'Admin',
        // ]);
        // Role::factory()->create([
        //     'name' => 'Staff',
        // ]);

        // Role::factory()->create([
        //     'name' => 'User',
        // ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
         // ]);
        \App\Models\User::factory()->create([
            'name' => 'Test Ilham ',
            'email' => 'ilham@admin.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test user ',
            'email' => 'user@user.com',
            'role' => 'user',
            'password' => Hash::make('45678912'),
        ]);
    }
}
