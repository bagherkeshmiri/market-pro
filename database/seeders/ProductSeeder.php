<?php

namespace Database\Seeders;

use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryId = Category::first()->id;
        $products = [
            [
                'name' => 'محصول یک',
                'status' => ProductStatus::NotExist,
                'price' => 50000,
                'stock' => 0,
            ],
            [
                'name' => 'محصول دو',
                'status' => ProductStatus::NotExist,
                'price' => 150000,
                'stock' => 4,
            ],
            [
                'name' => 'محصول سه',
                'status' => ProductStatus::NotExist,
                'price' => 200000,
                'stock' => 2,
            ],
            [
                'name' => 'محصول چهار',
                'status' => ProductStatus::NotExist,
                'price' => 250000,
                'stock' => 10,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'category_id' => $categoryId,
                'name' => $product['name'],
                'status' => $product['status'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
