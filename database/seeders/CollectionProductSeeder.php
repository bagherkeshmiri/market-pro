<?php

namespace Database\Seeders;

use App\Enums\CollectionType;
use App\Models\Collection;
use App\Models\CollectionProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CollectionProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $productCollectionId = Collection::where('type', CollectionType::Product)->value('id');

        $products = Product::get();

        $insertData = [];

        foreach ($products as $product) {
            $insertData[] = [
                'collection_id' => $productCollectionId,
                'product_id' => $product->id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($insertData)) {
            CollectionProduct::insert($insertData);
        }
    }
}
