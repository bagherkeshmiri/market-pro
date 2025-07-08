<?php

namespace App\Livewire\Admin\Comment;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Comment;

class ListComment extends AdminComponent
{
    public function render()
    {
        $pageTitle = 'لیست  نظرات';
        $tableHeads = ['کاربر', 'نوع نظر', 'وضعیت', 'تاریخ ایجاد', 'عملیات'];
        $comments = Comment::select([
            'id',
            'user_id',
            'commentable_id',
            'commentable_type',
            'status',
            'body',
            'created_at'
        ])->with([
            'user:id,name',
        ])
            ->paginate($this->perPage);

        return $this->renderView(
            'livewire.admin.comment.list-comment',
            compact('pageTitle', 'tableHeads', 'comments')
        );
    }
}
