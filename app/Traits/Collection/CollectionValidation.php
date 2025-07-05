<?php

namespace App\Traits\Collection;

use App\Enums\CollectionType;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

trait CollectionValidation
{
    public function validateCollectionSelection(): RedirectResponse|Redirector|null
    {
        $items = $this->type == CollectionType::Product ? $this->selectedProducts : $this->selectedCategories;
        $typeName = $this->type == CollectionType::Product ? 'محصول' : 'دسته بندی';

        if (count($items) > $this->limitation) {
            session()->flash('error', 'تعداد ' . $typeName . ' انتخاب شده نباید بیشتر از ' . $this->limitation . ' عدد باشد');
            return redirect()->route('admin.collection.show', ['collection' => $this->collection->id]);
        }

        if (empty($items)) {
            session()->flash('error', 'کالکشن نباید بدون ' . $typeName . ' ذخیره شود');
            return redirect()->route('admin.collection.show', ['collection' => $this->collection->id]);
        }

        return null;
    }
}
