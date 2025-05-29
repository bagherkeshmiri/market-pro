<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::query()->create([
            'fa_name' => 'ویرایش',
            'en_name' => 'edit',
        ]);

        Permission::query()->create([
            'fa_name' => 'نمایش',
            'en_name' => 'show',
        ]);

        Permission::query()->create([
            'fa_name' => 'ایجاد',
            'en_name' => 'create',
        ]);

        Permission::query()->create([
            'fa_name' => 'حذف',
            'en_name' => 'delete',
        ]);

        Permission::query()->create([
            'fa_name' => 'فعالسازی',
            'en_name' => 'enable',
        ]);

        Permission::query()->create([
            'fa_name' => 'غیرفعالسازی',
            'en_name' => 'disable',
        ]);
    }
}
