<?php

namespace App\Livewire\Admin\Post;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Post;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class CreatePost extends AdminComponent
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $excerpt;
    public $body;
    public $status;
    public $categoryId;
    public $image;

    public function mount(): void
    {
        $this->categoryId = Category::withoutTrashed()
            ->isPostCategory()
            ->first()->id;

        $this->status = IsActive::No;
    }

    public function render(): View
    {
        $pageTitle = 'ایجاد پست';
        $statuses = showEnumLabels(IsActive::class);
        $categories = Category::withoutTrashed()
            ->isPostCategory()
            ->select([
                'id',
                'name',
            ])
            ->pluck('id', 'name')
            ->toArray();

        return $this->renderView(
            'livewire.admin.post.create-post',
            $pageTitle,
            compact('statuses', 'categories')
        );
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'title' => 'required|min:10',
            'body' => 'required|min:100',
            'slug' => 'required|min:10|regex:/^[A-Za-z0-9\-]+$/',
            'categoryId' => 'required|exists:categories,id',
            'image' => 'nullable|file|mimes:jpg,png,jpeg,webp|max:500', // TODO reduce image size and width and height
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
            $createdPost = Post::create($data);

            if (!is_null($this->image)) {
                $createdPost->image()->create([
                    'url' => storeImage($this->image, 'posts'),
                    'is_main' => true,
                ]);
            }

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
