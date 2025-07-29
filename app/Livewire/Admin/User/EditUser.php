<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Throwable;

class EditUser extends Component
{
    public User $user;
    public $name;
    public $email;

    public function mount(): void
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render(): View
    {
        return view('livewire.admin.user.edit-user');
    }


    /**
     * @throws Throwable
     */
    public function update(): RedirectResponse|Redirector
    {
        $this->validate([
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
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
