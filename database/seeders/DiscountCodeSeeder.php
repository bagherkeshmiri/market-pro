<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class DiscountCodeSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('discount_codes')->insert([
            [
                'code' => 'SUMMER2025',
                'type' => 1,
                'is_active' => 0,
                'amount' => 20,
                'usage_limit' => 100,
                'used_count' => 0,
                'min_order_amount' => 50000,
                'expires_at' => $now->addMonth(),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'WELCOME50K',
                'type' => 2,
                'is_active' => 0,
                'amount' => 50000,
                'usage_limit' => 50,
                'used_count' => 0,
                'min_order_amount' => 200000,
                'expires_at' => $now->addMonths(2),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'BLACKFRIDAY',
                'type' => 1,
                'is_active' => 0,
                'amount' => 50,
                'usage_limit' => 10,
                'used_count' => 0,
                'min_order_amount' => 100000,
                'expires_at' => Carbon::create(2025, 11, 30),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

}
