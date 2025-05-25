<?php

namespace App\Http\Livewire\Admin\Account;

use App\Repositories\Admin\AdminRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class ListAccount extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected object $adminRepository;

    public function boot(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    public function render()
    {
        $mainAdminId = $this->adminRepository->first()->id;
        $admins = $this->adminRepository->paginate();
        return view('livewire.admin.account.list-account', ['admins' => $admins , 'mainAdminId' => $mainAdminId])->layout('layouts.admin-layout');
    }
}
