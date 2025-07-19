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
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'فانتزی',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'دخترانه',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'عروسکی',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'مجموعه ساعت',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'کالکشن کفش',
                'parent_id' => 6,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 6,
                'name' => 'پوشاک زنانه',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 8,
                'name' => 'کالکشن کیف',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 9,
                'name' => 'تجهیزات جانبی',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 10,
                'name' => 'مجموعه ساعت',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 11,
                'name' => 'عینک آفتابی',
                'parent_id' => null,
                'type' => CategoryType::Product,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 12,
                'name' => ' فشن',
                'parent_id' => null,
                'type' => CategoryType::Post,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'id' => 13,
                'name' => 'خیاطی',
                'parent_id' => null,
                'type' => CategoryType::Post,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
