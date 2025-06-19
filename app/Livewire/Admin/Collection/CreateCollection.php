<?php

namespace App\Livewire\Admin\Collection;

use App\Enums\CollectionType;
use App\Enums\IsActive;
use App\Livewire\BaseComponents\AdminComponent;
use App\Models\Collection;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Throwable;

class CreateCollection extends AdminComponent
{
    public $title;
    public $type;
    public $limitation;
    public $sort;
    public $isActive;

    public function render()
    {
        $pageTitle = 'ایجاد  کالکشن';
        $statuses = showEnumLabels(IsActive::class);
        $types = showEnumLabels(CollectionType::class);

        return $this->renderView(
            'livewire.admin.collection.create-collection',
            compact('pageTitle', 'statuses', 'types')
        );
    }


    /**
     * @throws Throwable
     */
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'type' => [
                'required',
                new Enum(CollectionType::class),
            ],
            'isActive' => [
                'required',
                new Enum(IsActive::class),
            ],
            'limitation' => 'required|min:0'
        ]);

        $data = [
            'title' => $this->title,
            'type' => $this->type,
            'is_active' => $this->isActive,
            'limitation' => $this->limitation,
        ];

        DB::beginTransaction();
        try {
            Collection::create($data);
            DB::commit();
            $this->reset(['title', 'limitation']);
            session()->flash('success', __('global.success_message'));
            return redirect()->route('admin.collection.index');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('error', __('global.error_message'));
            return redirect()->route('admin.collection.create');
        }
    }
}
