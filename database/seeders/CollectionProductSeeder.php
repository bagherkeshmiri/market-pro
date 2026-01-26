<?php

namespace Database\Seeders;

use App\Enums\CollectionType;
use App\Models\CollectionProduct;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CollectionProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categoryCollection = DB::table('collections')
            ->where('type', CollectionType::Product)
            ->first();

        $products = DB::table('products')
            ->get();

        $insertData = [];

        foreach ($products as $product) {
            $insertData[] = [
                'collection_id' => $categoryCollection->id,
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
