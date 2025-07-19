<?php

namespace App\Livewire\Admin\Post;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Post;

class ListPost extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست‌ سوالات متداول';
        $tableHeads = ['عنوان', 'اسلاگ','دسته', 'کاربر', 'وضعیت', 'تاریخ ایجاد', 'عملیات'];
        $posts = Post::paginate($this->perPage);
        return $this->renderView(
            'livewire.admin.post.list-post',
            $pageTitle,
            compact('tableHeads', 'posts')
        );
    }
}
