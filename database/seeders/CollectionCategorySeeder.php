<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Enums\CollectionType;
use App\Models\CollectionCategory;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CollectionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categoryCollection = DB::table('collections')
            ->where('type', CollectionType::Category)
            ->first();

        $productCategory = DB::table('categories')
            ->where('type', CategoryType::Product)
            ->first();

        CollectionCategory::insert([
            [
                'collection_id' => $categoryCollection->id,
                'category_id' => $productCategory->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => $categoryCollection->id,
                'category_id' => $productCategory->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => $categoryCollection->id,
                'category_id' => $productCategory->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => $categoryCollection->id,
                'category_id' => $productCategory->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => $categoryCollection->id,
                'category_id' => $productCategory->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'collection_id' => $categoryCollection->id,
                'category_id' => $productCategory->id,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
