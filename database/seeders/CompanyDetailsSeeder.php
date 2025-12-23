<?php

namespace Database\Seeders;

use App\Models\CompanyDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyDetails::create([
            'user_id' => 1,
            'company_name' => 'Darjeeling Cab',
            'company_email' => 'info@darjeelingcab.in',
            'whatsapp_number' => '+918967386612',
            'phones' => json_encode([
                8967386612,
                7478459652,
                9339342603
            ]),
            'address' => "Peshok, Peshok Tea Garden, Rangli Rangliot, Darjeeling, West Bengal - 734312",
            'facebook_url' => "https://www.facebook.com/profile.php?id=61552052485531",
            'instagram_url' => "https://instagram.com/darjeeling.cab",
            'twitter_url' => null
        ]);
    }
}
