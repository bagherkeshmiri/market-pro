<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Enums\DiscountType;
use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryId = Category::where('type', CategoryType::Product)
            ->value('id');

        $products = [
            [
                'name' => 'کیف پنبه ای اداری ضد آب',
                'status' => ProductStatus::NotExist,
                'discount_type' => DiscountType::Amount,
                'price' => 450000,
                'discount' => 150000,
                'final_price' => 300000,
                'stock' => 2,
            ],
            [
                'name' => 'لباس مجلسی مونیکا دیارا',
                'status' => ProductStatus::NotExist,
                'discount_type' => DiscountType::Percent,
                'price' => 150000,
                'discount' => 4,
                'final_price' => 144000,
                'stock' => 4,
            ],
            [
                'name' => 'صندل گل مشکل اونیما',
                'status' => ProductStatus::NotExist,
                'discount_type' => DiscountType::Amount,
                'price' => 200000,
                'discount' => 0,
                'final_price' => 200000,
                'stock' => 2,
            ],
            [
                'name' => 'پیراهن بهاره',
                'status' => ProductStatus::Exist,
                'discount_type' => DiscountType::Amount,
                'price' => 250000,
                'discount' => 0,
                'final_price' => 250000,
                'stock' => 10,
            ],
            [
                'name' => 'ژاکت پانچو بین المللی',
                'status' => ProductStatus::Exist,
                'discount_type' => DiscountType::Amount,
                'price' => 264000,
                'discount' => 0,
                'final_price' => 264000,
                'stock' => 10,
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'category_id' => $categoryId,
                'long_description' => self::longDescription(),
                'short_description' => self::shortDescription(),
                'additional_information' => self::additionalInformation(),
            ]));
        }
    }

    private static function longDescription(): string
    {
        return '<p>لورم ایپسوم متن ساختگی...</p>';
    }

    private static function shortDescription(): string
    {
        return '<p>لورم ایپسوم کوتاه...</p>';
    }

    private static function additionalInformation(): string
    {
        return '<figure class="table"><table><tbody>...</tbody></table></figure>';
    }
}
