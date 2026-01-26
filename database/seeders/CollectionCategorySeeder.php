<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Enums\CollectionType;
use App\Models\Category;
use App\Models\Collection;
use App\Models\CollectionCategory;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CollectionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $productCollectionId = Collection::where('type', CollectionType::Category)->value('id');

        $categories = Category::get();

        $insertData = [];

        foreach ($categories as $category) {
            $insertData[] = [
                'collection_id' => $productCollectionId,
                'category_id' => $category->id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($insertData)) {
            CollectionCategory::insert($insertData);
        }
    }
}
