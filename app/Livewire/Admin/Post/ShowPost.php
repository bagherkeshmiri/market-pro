<?php

namespace App\Livewire\Admin\Post;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowPost extends AdminComponent
{
    public Post $post;
    public $title;
    public $slug;
    public $excerpt;
    public $body;
    public $status;
    public $categoryId;

    public function mount(Post $post): void
    {
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->excerpt = $post->excerpt;
        $this->body = $post->body;
        $this->status = $post->status;
        $this->categoryId = $post->category_id;
    }

    public function render(): View
    {
        $statuses = showEnumLabels(IsActive::class);
        $categories = Category::withoutTrashed()
            ->isPostCategory()
            ->select([
                'id',
                'name',
            ])
            ->pluck('id', 'name')
            ->toArray();
        $pageTitle = 'ویرایش پست' . $this->post->title;
        return $this->renderView(
            'livewire.admin.post.show-post',
            $pageTitle,
            compact('statuses', 'categories')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'title' => 'required|min:10',
            'body' => 'required|min:100',
            'slug' => 'required|min:10|regex:/^[A-Za-z0-9\-]+$/',
            'categoryId' => 'required|exists:categories,id',
            'status' => [
                'required',
                new Enum(IsActive::class)
            ],
        ]);

        $data = [
            'user_id' => auth()->user()->id,
            'category_id' => $this->categoryId,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'status' => $this->status,
        ];

        DB::beginTransaction();
        try {
            $this->post->update($data);

            DB::commit();
            $this->reset(['title']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.post.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.post.create');
        }
    }
}
