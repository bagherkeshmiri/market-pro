<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'چطور می‌توانم سفارشم را ثبت کنم؟',
                'answer' => 'برای ثبت سفارش، محصول مورد نظر را به سبد خرید اضافه کرده، سپس به صفحه پرداخت بروید و اطلاعات تماس و آدرس خود را وارد کنید.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'چه روش‌هایی برای پرداخت وجود دارد؟',
                'answer' => 'در حال حاضر، امکان پرداخت از طریق درگاه بانکی (کارت‌های عضو شتاب) و پرداخت در محل فراهم است.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'مدت زمان ارسال سفارش چقدر است؟',
                'answer' => 'سفارش‌ها معمولاً بین ۲ تا ۵ روز کاری بسته به محل زندگی شما تحویل داده می‌شوند.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'آیا پس از ثبت سفارش امکان تغییر یا لغو آن وجود دارد؟',
                'answer' => 'در صورتی که سفارش هنوز ارسال نشده باشد، می‌توانید با پشتیبانی تماس بگیرید.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'آیا محصولات فروشگاه دارای گارانتی هستند؟',
                'answer' => 'بله، اکثر محصولات دارای ضمانت سلامت فیزیکی و گارانتی معتبر هستند.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'چطور می‌توانم وضعیت سفارش خود را پیگیری کنم؟',
                'answer' => 'با ورود به حساب کاربری یا استفاده از کد رهگیری، وضعیت سفارش را بررسی کنید.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'آیا امکان مرجوع کردن کالا وجود دارد؟',
                'answer' => 'بله، در صورت مشکل یا مغایرت، می‌توانید کالا را تا ۷ روز بازگردانید.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question' => 'چگونه می‌توانم با پشتیبانی تماس بگیرم؟',
                'answer' => 'پشتیبانی از ساعت ۹ تا ۲۱ از طریق شماره تماس یا چت آنلاین در دسترس است.',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('faqs')->insert($faqs);
    }
}
