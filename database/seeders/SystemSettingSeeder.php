<?php

namespace Database\Seeders;

use App\Enums\SystemSettingType;
use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        $systemSettings = [
            [
                'label' => 'نام فروشگاه',
                'key' => 'site_title',
                'value' => 'مارکت پرو',
                'type' => SystemSettingType::String,
            ],
            [
                'label' => 'ساعت کاری فروشگاه',
                'key' => 'site_working_hour',
                'value' => 'همه روزه از ۸ صبح تا ۶ عصر',
                'type' => SystemSettingType::String,
            ],
            [
                'label' => 'ایمیل فروشگاه',
                'key' => 'site_email',
                'value' => 'support@example.com',
                'type' => SystemSettingType::String,
            ],
            [
                'label' => 'آدرس فروشگاه',
                'key' => 'site_address',
                'value' => 'تهران ، خیابان گل ، پلاک ۱۲۳',
                'type' => SystemSettingType::String,
            ],
        ];

        foreach ($systemSettings as $systemSetting) {
            SystemSetting::create($systemSetting);
        }
    }
}
