<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::all();
        $now = Carbon::now();

        $adminRole = Role::create([
            'fa_name' => 'مدیر',
            'en_name' => 'admin',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $adminRole->permissions()->attach($permissions);
    }
}
