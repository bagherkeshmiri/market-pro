<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::query()->value('id');
        $categoryId = Category::where('type', CategoryType::Post)->value('id');

        $body = self::body();

        $posts = [
            ['title' => 'پوشاک مناسب تابستان', 'slug' => 'summer-clothing'],
            ['title' => '12 روز یا 12 سال؟', 'slug' => '12-days-or-12-years'],
            ['title' => 'گزارش اختصاصی: گردهمایی بزرگ فعالان صنعت پوشاک ایران به میزبانی انجمن نشان‌های تجاری', 'slug' => 'exclusive-report-large-gathering-iranian-clothing'],
            ['title' => 'حضور رامینا ترابی در کن ۲۰۲۵', 'slug' => 'ramina-torabis-presence-cannes-2025'],
            ['title' => 'مد چیست؟ همه چیز درباره ی مد و فشن', 'slug' => 'what-is-fashion'],
            ['title' => '5 راه برای ست کردن تیشرت لانگ با انواع استایل', 'slug' => 'ways-to-pair-long-t-shirt'],
            ['title' => 'وسایل طراحی لباس', 'slug' => 'clothing-design-tools'],
            ['title' => 'برند نیو بوی با برندهای برتر ایرانی در گردهمایی برندها', 'slug' => 'newboy-top-iranian-brands'],
            ['title' => 'همه چیز درباره ی برند نیوبوی', 'slug' => 'about-newboy-brand'],
        ];

        foreach ($posts as $post) {
            Post::create([
                'user_id' => $userId,
                'category_id' => $categoryId,
                'title' => $post['title'],
                'slug' => $post['slug'],
                'excerpt' => self::excerpt(),
                'body' => $body,
                'status' => 1,
            ]);
        }
    }

    private static function body(): string
    {
        return '<h2><strong>امروزه بهترین نوع پوشاک رو میبینیم</strong></h2><p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز</p><p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیازلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز</p><blockquote><p><strong>“لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است”</strong></p></blockquote><p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p><p><img class="image_resized" src="http://localhost/roiser/assets/img/blog/blog-details-img-1.png" alt="blog"><img class="image_resized" src="http://localhost/roiser/assets/img/blog/blog-details-img-2.png" alt="blog"></p><p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک استلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>';
    }

    private static function excerpt(): string
    {
        return 'امروزه بهترین نوع پوشاک رو میبینیملورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای';
    }
}
