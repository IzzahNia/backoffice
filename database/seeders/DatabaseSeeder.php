<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create a Super Admin user
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@backoffice.test',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'role' => 'admin', // Assign the 'admin' role to the Super Admin
        ]);

        // Create 20 random users with roles
        User::factory(50)->create();
    }
}
