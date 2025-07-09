<?php

namespace App\Livewire\Site;

use App\Enums\CommentStatus;
use App\Models\Comment;
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

class ProductReviewForm extends Component
{
    public $productId;
    public $name;
    public $email;
    public $message;
    public $canSubmit = true;

    public function mount($productId): void
    {
        $this->productId = $productId;

        $this->checkIfUserCanSubmit();
    }

    public function render(): View
    {
        return view('livewire.site.product-review-form');
    }

    private function checkIfUserCanSubmit(): void
    {
        $user = auth()->user();

        if (!$user) {
            $this->canSubmit = false;
            return;
        }

        $recentReview = $user->comments()
            ->where('commentable_id', $this->productId)
            ->where('commentable_type', Product::class)
            ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
            ->where('status', CommentStatus::Pending)
            ->exists();

        $this->canSubmit = !$recentReview;


//        dd(
//            $user->comments()
//                ->where('commentable_id', $this->productId)
//                ->where('commentable_type', Product::class)
//                ->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())
//                ->where('status', CommentStatus::Pending)
//                ->dd()
//        );
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
            $product = Product::find($this->productId);

            if (is_null($product)) {
                session()->flash('error', 'محصول مورد نظر یافت نشد');
                return redirect()->route('site.single-product', ['product' => $this->productId]);
            }

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'body' => $this->message,
                'user_id' => auth()->user()->id ?? null,
            ];

            $product->comments()->create($data);

            DB::commit();
            session()->flash('success', 'نظر شما با موفقیت ثبت شد و ئس از تایید نمایش داده می‌شود و تا 24 ساعت آینده امکان ثبت نظر وجود ندارد ');
            return redirect()->route('site.single-product', ['product' => $this->productId]);
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('site.single-product', ['product' => $this->productId]);
        }
    }


}
