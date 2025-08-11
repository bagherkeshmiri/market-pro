<?php

namespace App\Livewire\Site;

use App\Enums\CommentStatus;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class PostCommentForm extends Component
{
    public $postId;
    public $name;
    public $email;
    public $message;
    public $canSubmit = true;

    public function mount($postId): void
    {
        $this->postId = $postId;

        $this->checkIfUserCanSubmit();
    }

    public function render(): View
    {
        return view('livewire.site.post-comment-form');
    }

    private function checkIfUserCanSubmit(): void
    {
        $user = auth('web')->user();

        if (!$user) {
            $this->canSubmit = false;
            return;
        }

        $recentReview = $user->comments()
            ->where('commentable_id', $this->postId)
            ->where('commentable_type', Post::class)
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->where('status', CommentStatus::Pending)
            ->exists();

        $this->canSubmit = !$recentReview;
    }

    /**
     * @throws Throwable
     */
    public function submit(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $post = Post::find($this->postId);

            if (is_null($post)) {
                session()->flash('error', 'پست مورد نظر یافت نشد');
                return redirect()->route('site.single-post', ['post' => $post->slug]);
            }

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'body' => $this->message,
                'user_id' => auth('web')->user()->id ?? null,
            ];

            $post->comments()->create($data);

            DB::commit();
            session()->flash('success', 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده می‌شود و تا 24 ساعت آینده امکان ثبت نظر وجود ندارد ');
            return redirect()->route('site.single-post', ['post' => $post->slug]);
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('site.single-post', ['post' => $post->slug]);
        }
    }


}
