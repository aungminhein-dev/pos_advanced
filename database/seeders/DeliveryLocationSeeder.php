<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeliveryLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = ['Yangon Region','Mandalay Region','Magway Region','Bago Region','Ayeyarwady Region','Tanintharyi Region','Sagaing Region','Kachin State','Kayar State','Kayin State','Chin State','Mon State','Rakhine State','Shan State'];

        foreach ($states as $state) {
            DeliveryLocation::factory()->create(['name' => $state]);
        }
    }
}
