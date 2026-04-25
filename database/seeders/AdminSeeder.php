<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
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
