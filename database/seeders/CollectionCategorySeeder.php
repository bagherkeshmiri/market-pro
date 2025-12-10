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
                'collection_id' => 1,
                'category_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => 1,
                'category_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => 1,
                'category_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => 1,
                'category_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => 1,
                'category_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => 1,
                'category_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
