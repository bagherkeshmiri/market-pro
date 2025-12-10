<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            [
                'name' => 'مجموعه ساعت',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => $now,
            ],
            [
                'name' => 'کالکشن کفش',
                'type' => CategoryType::Product,
                'parent_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
            [
                'name' => 'پوشاک زنانه',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
            [
                'name' => 'کالکشن کیف',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
            [
                'name' => 'دانش نامه',
                'parent_id' => null,
                'type' => CategoryType::Post,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
        ]);
    }
}
