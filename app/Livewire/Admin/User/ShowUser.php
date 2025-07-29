<?php

namespace App\Livewire\Admin\User;

use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class ShowUser extends AdminComponent
{
    public User $user;
    public $name;
    public $email;
    public $mobile;

    public function mount(): void
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->mobile = $this->user->mobile;
    }

    public function render(): View
    {
        $pageTitle = 'ویرایش کاربر';
        $payments = Payment::whereUserId($this->user->id)->paginate($this->perPage);
        $paymentTableHeads = [
            'شماره سفارش',
            'درگاه',
            'شماره پرداخت',
            'وضعیت',
            'مبلغ',
            'شناسه پیگیری',
            'تاریخ پرداخت',
            'تاریخ ایجاد',
            'عملیات'
        ];
        return $this->renderView(
            'livewire.admin.user.show-user',
            $pageTitle,
            compact('paymentTableHeads','payments')
        );
    }

    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'mobile' => [
                'nullable',
                'digits:11',
                Rule::unique('users', 'mobile')->ignore($this->user->id),
            ],
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ];

        DB::beginTransaction();
        try {
            $this->user->update($data);
            DB::commit();
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.user.show', ['user' => $this->user->id]);
        } catch (Exception $e) {
            DB::rollBack();
            if (app()->isLocal()) {
                session()->flash('error', $e->getMessage());
            } else {
                session()->flash('error', __('global.error_message'));
            }
            return redirect()->route('admin.user.show', ['user' => $this->user->id]);
        }
    }
}
