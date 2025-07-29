<?php

namespace Database\Seeders;

use App\Models\City;
use File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * @throws FileNotFoundException
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('data/cities.json'));
        $provinces = json_decode($json, true);

        foreach ($provinces as $province) {
            $provinceId = $province['province_id'];
            $cities = $province['cities'];

            foreach ($cities as $cityName) {
                City::updateOrCreate(
                    ['name' => $cityName],
                    ['province_id' => $provinceId]
                );
            }

            $this->command->info("✅ شهرهای استان {$province['province_name']} ثبت شدند");
        }
    }
}
