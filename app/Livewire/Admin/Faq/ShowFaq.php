<?php

namespace App\Livewire\Admin\Faq;

use App\Enums\DiscountType;
use App\Enums\IsActive;
use App\Enums\ProductStatus;
use App\Jobs\DeleteImageJob;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Faq;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowFaq extends AdminComponent
{
    public Faq $faq;
    public $question;
    public $answer;
    public $isActive;

    public function mount(Faq $faq): void
    {
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->isActive = $faq->is_active;
    }

    public function render(): View
    {
        $pageTitle = 'ویرایش سوال متداول';
        $statuses = showEnumLabels(IsActive::class);
        return $this->renderView(
            'livewire.admin.faq.show-faq',
            $pageTitle,
            compact('statuses')
        );
    }


    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'question' => 'required',
            'answer' => 'required',
            'isActive' => [
                'required',
                new Enum(IsActive::class)
            ],
        ]);

        $data = [
            'question' => $this->question,
            'answer' => $this->answer,
            'is_active' => $this->isActive,
        ];

        DB::beginTransaction();
        try {
            $this->faq->update($data);

            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.faq.show', ['faq' => $this->faq->id]);
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.faq.show', ['faq' => $this->faq->id]);
        }
    }
}
