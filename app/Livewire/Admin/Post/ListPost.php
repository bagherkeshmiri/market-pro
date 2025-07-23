<?php

namespace App\Livewire\Admin\Post;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Post;
use Illuminate\View\View;

class ListPost extends AdminComponent
{
    public function render(): View
    {
        $pageTitle = 'لیست‌ پست ها';
        $tableHeads = ['عنوان', 'اسلاگ','دسته', 'کاربر', 'وضعیت', 'تاریخ ایجاد', 'عملیات'];
        $posts = Post::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.post.list-post',
            $pageTitle,
            compact('tableHeads', 'posts')
        );
    }
}
