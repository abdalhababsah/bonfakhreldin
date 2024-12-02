<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', // Change to a valid email
            'password' => Hash::make('password'), // Change to a secure password
        ]);

        // Optionally, create more users
        User::factory()->count(10)->create();
    }
}