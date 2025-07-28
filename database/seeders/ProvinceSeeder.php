<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $provinces = [
            ['name' => 'آذربایجان شرقی', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'آذربایجان غربی', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'اردبیل', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'اصفهان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'البرز', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ایلام', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'بوشهر', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'تهران', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'چهارمحال و بختیاری', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'خراسان جنوبی', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'خراسان رضوی', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'خراسان شمالی', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'خوزستان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'زنجان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'سمنان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'سیستان و بلوچستان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'فارس', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'قزوین', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'قم', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'کردستان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'کرمان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'کرمانشاه', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'کهگیلویه و بویراحمد', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'گلستان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'گیلان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'لرستان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'مازندران', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'مرکزی', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'هرمزگان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'همدان', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'یزد', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
