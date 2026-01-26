<?php

namespace Database\Seeders;

use App\Enums\CommentStatus;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $userId = User::query()->value('id');
        $postId = Post::query()->value('id');


        $comments = [
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => 'متن نظر تست 1',
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => 'متن نظر تست 2',
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => 'متن نظر تست 3',
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => 'متن نظر تست 4',
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => self::longBody(),
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است...',
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => 'سادگی نامفهوم از صنعت چاپ و گرافیک است...',
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => 'متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ...',
            ],
            [
                'type' => Post::class,
                'id' => $postId,
                'body' => self::multilineBody(),
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create([
                'user_id' => $userId,
                'commentable_id' => $comment['id'],
                'commentable_type' => $comment['type'],
                'status' => CommentStatus::Approved,
                'body' => $comment['body'],
            ]);
        }
    }

    private static function longBody(): string
    {
        return 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است...';
    }

    private static function multilineBody(): string
    {
        return "متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ\nمتن ساختگی با تولید سادگی نامفهوم از صنعت چاپ\nمتن ساختگی با تولید سادگی نامفهوم از صنعت چاپ";
    }
}
