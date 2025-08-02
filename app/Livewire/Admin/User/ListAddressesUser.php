<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListAddressesUser extends Component
{
    use WithPagination;

    public User $user;

    public function render(): View
    {
        $addresses = UserAddress::whereUserId($this->user->id)->paginate(2);
        $addressTableHeads = [
            'استان',
            'شهر',
            'آدرس',
            'کد پستی',
        ];
        return view(
            'livewire.admin.user.list-addresses-user',
            compact('addressTableHeads', 'addresses')
        );
    }
}
