<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactUs;
use Faker\Factory as Faker;

class ContactUsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) { // Create 10 dummy contact messages
            ContactUs::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->optional()->phoneNumber,
                'message' => $faker->paragraph,
                'status' => 'new',
            ]);
        }
    }
}