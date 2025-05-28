<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::all();

        $adminRole = Role::query()->create([
            'fa_name' => 'ادمین',
            'en_name' => 'admin',
        ]);
        $adminRole->permissions()->attach($permissions);
    }
}
