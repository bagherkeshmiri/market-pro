<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class GateOrgSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('gates_org')->insert([
            [
                'id' => 1,
                'gate_id' => 1,
                'label' => 'زرین پال',
                'is_active' => true,
                'is_default' => true,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'gate_id' => 2,
                'label' => 'پی پینگ',
                'is_active' => false,
                'is_default' => false,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
            ],
        ]);
    }
}
