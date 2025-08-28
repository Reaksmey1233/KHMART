<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@khmart.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Create a test customer user
        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@khmart.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
