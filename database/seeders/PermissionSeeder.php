<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $permissions = [
            ['fa_name' => 'ویرایش',       'en_name' => 'edit'],
            ['fa_name' => 'نمایش',        'en_name' => 'show'],
            ['fa_name' => 'ایجاد',        'en_name' => 'create'],
            ['fa_name' => 'حذف',          'en_name' => 'delete'],
            ['fa_name' => 'فعالسازی',     'en_name' => 'enable'],
            ['fa_name' => 'غیرفعالسازی',  'en_name' => 'disable'],
        ];

        $permissions = array_map(fn($permission) => array_merge($permission, [
            'created_at' => $now,
            'updated_at' => $now,
        ]), $permissions);

        Permission::insert($permissions);
    }
}
