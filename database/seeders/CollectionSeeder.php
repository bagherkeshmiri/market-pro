<?php

namespace Database\Seeders;

use App\Enums\CollectionType;
use App\Models\Collection;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        Collection::insert([
            [
                'title' => 'فروش ویژه',
                'type' => CollectionType::Product,
                'limitation' => 10,
                'sort' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'تابستانه',
                'type' => CollectionType::Category,
                'limitation' => 8,
                'sort' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
