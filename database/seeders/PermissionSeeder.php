<?php

namespace Database\Seeders;

use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            [
                'fa_name' => 'ویرایش',
                'en_name' => 'edit',
            ],
            [
                'fa_name' => 'نمایش',
                'en_name' => 'show',
            ],
            [
                'fa_name' => 'ایجاد',
                'en_name' => 'create',
            ],
            [
                'fa_name' => 'حذف',
                'en_name' => 'delete',
            ],
            [
                'fa_name' => 'فعالسازی',
                'en_name' => 'enable',
            ],
            [
                'fa_name' => 'غیرفعالسازی',
                'en_name' => 'disable',
            ]
        ];


        foreach ($permissions as $permission) {
            Permission::query()->create([
                'fa_name' => $permission['fa_name'],
                'en_name' => $permission['en_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
