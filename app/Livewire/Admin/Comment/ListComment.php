<?php

namespace App\Livewire\Admin\Comment;

use App\Enums\CommentStatus;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Comment;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ListComment extends AdminComponent
{
    public function render(): View
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
            $pageTitle,
            compact('tableHeads', 'comments')
        );
    }


    /**
     * @throws Throwable
     */
    public function approve(Comment $comment): RedirectResponse|Redirector
    {
        DB::beginTransaction();
        try {
            $comment->update([
                'status' => CommentStatus::Approved,
            ]);

            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.comment.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.comment.index');
        }
    }

    /**
     * @throws Throwable
     */
    public function reject(Comment $comment): RedirectResponse|Redirector
    {
        DB::beginTransaction();
        try {
            $comment->update([
                'status' => CommentStatus::Rejected,
            ]);

            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.comment.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.comment.index');
        }
    }
}
