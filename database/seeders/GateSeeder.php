<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class GateSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('gates')->insert([
            [
                'id' => 1,
                'name' => 'zarinpal',
                'label' => 'زرین پال',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'label' => 'پی پینگ',
                'name' => 'payping',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
        ]);
    }
}
