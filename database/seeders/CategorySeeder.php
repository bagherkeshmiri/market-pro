<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'فانتزی',
            'دخترانه',
            'عروسکی',
            'سفارشی',
            'شکلی',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'parent_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
