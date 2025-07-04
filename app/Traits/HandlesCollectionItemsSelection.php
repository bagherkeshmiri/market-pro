<?php

namespace App\Traits;

trait HandlesCollectionItemsSelection
{
    protected function selectItem(int|string $id, string $name, string $selectedProperty, string $unselectedProperty): void
    {
        if (!in_array($id, array_column($this->{$selectedProperty}, 'id'))) {
            $this->{$selectedProperty}[] = ['id' => $id, 'name' => $name];
            $this->{$unselectedProperty} = collect($this->{$unselectedProperty})
                ->reject(fn($item) => $item['id'] == $id)
                ->values()
                ->toArray();
        }
    }

    protected function unselectItem(int|string $id, string $name, string $selectedProperty, string $unselectedProperty): void
    {
        $this->{$unselectedProperty}[] = ['id' => $id, 'name' => $name];
        $this->{$selectedProperty} = collect($this->{$selectedProperty})
            ->reject(fn($item) => $item['id'] == $id)
            ->values()
            ->toArray();
    }
}
