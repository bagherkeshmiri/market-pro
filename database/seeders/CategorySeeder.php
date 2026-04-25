<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'مجموعه ساعت', 'type' => CategoryType::Product],
            ['name' => 'دانش نامه',   'type' => CategoryType::Post],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'type' => $category['type'],
                'parent_id' => null,
            ]);
        }
    }
}
