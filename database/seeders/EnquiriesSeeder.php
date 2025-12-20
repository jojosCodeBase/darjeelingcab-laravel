<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EnquiriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // $statuses = ['new', 'contacted', 'quoted', 'confirmed', 'cancelled'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('enquiries')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'subject' => $faker->sentence(4), // Generates a 4-word subject
                'message' => $faker->paragraph(3),  // Generates a 3-sentence message
                // 'status'  => $statuses[array_rand($statuses)], // Picks a random status
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
