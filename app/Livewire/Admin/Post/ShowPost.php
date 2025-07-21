<?php

namespace App\Livewire\Admin\Post;

use App\Enums\IsActive;
use App\Jobs\DeleteImageJob;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithFileUploads;
use Throwable;

class ShowPost extends AdminComponent
{
    use WithFileUploads;

    public Post $post;
    public $title;
    public $slug;
    public $excerpt;
    public $body;
    public $status;
    public $categoryId;
    public $image;

    public function mount(Post $post): void
    {
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->excerpt = $post->excerpt;
        $this->body = $post->body;
        $this->status = $post->status;
        $this->categoryId = $post->category_id;
        $this->image = $post->image?->url ?? '';
    }

    public function render(): View
    {
        $pageTitle = ' ویرایش پست ' . $this->post->title;
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
            'image' => $this->image instanceof TemporaryUploadedFile
                ? 'file|mimes:jpg,png,jpeg,webp|max:500' // TODO reduce image size and width and height
                : 'nullable',
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

            if (!empty($this->image) and $this->image instanceof TemporaryUploadedFile) {
                $postImage = $this->post->image;
                if (!is_null($postImage)) {
                    DeleteImageJob::dispatch($postImage->url);
                    $postImage->delete();
                }

                $this->post->image()->create([
                    'url' => storeImage($this->image, 'posts'),
                    'is_main' => true,
                ]);
            }

            DB::commit();
            $this->reset(['title']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.post.index');
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.post.show', ['post' => $this->post->slug]);
        }
    }
}
