<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TourEnquiriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $statuses = ['new', 'quote_sent', 'confirmed'];
        $vehicles = ['WagonR', 'Innova', 'Tata Sumo', 'Swift Dzire', 'Bolero'];

        foreach (range(1, 10) as $index) {
            $startDate = $faker->dateTimeBetween('now', '+1 month');
            // Ensures end_date is always after start_date
            $endDate = $faker->dateTimeBetween($startDate, $startDate->format('Y-m-d') . ' +10 days');

            DB::table('tour_enquiries')->insert([
                'enq_id' => 'ENQ-' . $faker->unique()->numberBetween(1000, 9999),
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'phone' => $faker->phoneNumber,
                'from_location' => $faker->city,
                'to_location' => $faker->city,
                'no_of_pax' => $faker->numberBetween(1, 15),
                'vehicle_type' => $faker->randomElement($vehicles),
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'message' => $faker->sentence(10),
                'status' => $faker->randomElement($statuses),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
