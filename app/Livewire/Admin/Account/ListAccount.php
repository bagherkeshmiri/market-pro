<?php

namespace App\Livewire\Admin\Account;

use App\Livewire\BaseComponents\AdminComponent;
use App\Repositories\Admin\AdminRepositoryInterface;
use Livewire\WithPagination;

class ListAccount extends AdminComponent
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
        return $this->renderView('livewire.admin.account.list-account', ['admins' => $admins , 'mainAdminId' => $mainAdminId]);
    }
}
