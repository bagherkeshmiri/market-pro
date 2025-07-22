<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CollectionProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('collection_products')->insert([
            [
                'id' => 1,
                'collection_id' => 2,
                'product_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'collection_id' => 2,
                'product_id' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'collection_id' => 2,
                'product_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'collection_id' => 2,
                'product_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'collection_id' => 2,
                'product_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
