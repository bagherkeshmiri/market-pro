<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'مدیر اصلی',
                'role_id' => 1,
                'email' => 'admin@gmail.com',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );
    }
}
