<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();


        $user = DB::table('users')
            ->first();

        Comment::insert([
            [
                'user_id' => $user->id,
                'commentable_id' => 1,
                'commentable_type' => Category::class,
                'status' => 2,
                'body' => 'متن نظر تست 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 1,
                'commentable_type' => Product::class,
                'status' => 2,
                'body' => 'متن نظر تست 2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 1,
                'commentable_type' => Product::class,
                'status' => 2,
                'body' => 'متن نظر تست 3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 1,
                'commentable_type' => Product::class,
                'status' => 2,
                'body' => 'متن نظر تست 4',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 1,
                'commentable_type' => Product::class,
                'status' => 2,
                'body' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 9,
                'commentable_type' => Post::class,
                'status' => 2,
                'body' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است...',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 9,
                'commentable_type' => Post::class,
                'status' => 2,
                'body' => 'سادگی نامفهوم از صنعت چاپن گرافیک است...',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 9,
                'commentable_type' => Post::class,
                'status' => 2,
                'body' => 'متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ...',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $user->id,
                'commentable_id' => 9,
                'commentable_type' => Post::class,
                'status' => 2,
                'body' => "متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است\nمتن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است\nمتن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است",
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
