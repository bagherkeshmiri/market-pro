<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CollectionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('collection_categories')->insert([
            [
                'id' => 7,
                'collection_id' => 1,
                'category_id' => 8,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'collection_id' => 1,
                'category_id' => 9,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'collection_id' => 1,
                'category_id' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 11,
                'collection_id' => 1,
                'category_id' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 12,
                'collection_id' => 1,
                'category_id' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 13,
                'collection_id' => 1,
                'category_id' => 11,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
