<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'کاربر یک',
                'email' => 'user@gmail.com',
                'password' => '12345678',
                'email_verified_at' => now(),
            ]
        );
    }
}
