<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('collections')->insert([
            [
                'id' => 1,
                'title' => 'فروش ویژه',
                'type' => 2,
                'limitation' => 10,
                'sort' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'title' => 'تابستانه',
                'type' => 1,
                'limitation' => 8,
                'sort' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
