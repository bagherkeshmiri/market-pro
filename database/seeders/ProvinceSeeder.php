<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $provinceNames = [
            'آذربایجان شرقی', 'آذربایجان غربی', 'اردبیل', 'اصفهان', 'البرز', 'ایلام', 'بوشهر',
            'تهران', 'چهارمحال و بختیاری', 'خراسان جنوبی', 'خراسان رضوی', 'خراسان شمالی',
            'خوزستان', 'زنجان', 'سمنان', 'سیستان و بلوچستان', 'فارس', 'قزوین', 'قم',
            'کردستان', 'کرمان', 'کرمانشاه', 'کهگیلویه و بویراحمد', 'گلستان', 'گیلان',
            'لرستان', 'مازندران', 'مرکزی', 'هرمزگان', 'همدان', 'یزد'
        ];

        $provinces = array_map(fn($name) => [
            'name' => $name,
            'created_at' => $now,
            'updated_at' => $now,
        ], $provinceNames);

        Province::insert($provinces);
    }
}
