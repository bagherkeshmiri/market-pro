<?php

namespace App\Livewire\Admin\Faq;

use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Faq;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class CreateFaq extends AdminComponent
{
    public $question;
    public $answer;
    public $status;

    public function mount(): void
    {
        $this->status = IsActive::No;
    }

    public function render(): View
    {
        $statuses = showEnumLabels(IsActive::class);
        $pageTitle = 'ایجاد سوال متداول';
        return $this->renderView(
            'livewire.admin.faq.create-faq',
            $pageTitle,
            compact('statuses')
        );
    }

    /**
     * @throws Throwable
     */
    public function store(): RedirectResponse|Redirector
    {
        $this->validate([
            'question' => 'required',
            'answer' => 'required',
            'status' => [
                'required',
                new Enum(IsActive::class)
            ],
        ]);


        $data = [
            'question' => $this->question,
            'answer' => $this->answer,
            'status' => $this->status,
        ];

        DB::beginTransaction();
        try {
            Faq::create($data);

            DB::commit();
            $this->reset(['question']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.faq.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.faq.create');
        }
    }
}
