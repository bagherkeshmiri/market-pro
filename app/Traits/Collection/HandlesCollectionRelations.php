<?php

namespace App\Traits\Collection;

use App\Enums\CollectionType;
use BackedEnum;

trait HandlesCollectionRelations
{
    protected function getCollectionMap(): array
    {
        return [
            CollectionType::Product->value => [
                'items' => $this->selectedProducts ?? [],
                'relation' => 'productCollection',
                'key' => 'product_id',
            ],
            CollectionType::Category->value => [
                'items' => $this->selectedCategories ?? [],
                'relation' => 'categoryCollection',
                'key' => 'category_id',
            ],
        ];
    }

    protected function getTypeKey(): mixed
    {
        $type = $this->type;

        if (is_array($type)) {
            $type = $type[0] ?? null;
        }

        if ($type instanceof BackedEnum) {
            return $type->value;
        }

        return $type;
    }

    private function saveItemsToCollection($collection, bool $shouldDeleteExisting = false): void
    {
        $map = $this->getCollectionMap();
        $typeKey = $this->getTypeKey();

        if (!isset($map[$typeKey])) {
            return;
        }

        $config = $map[$typeKey];

        if ($shouldDeleteExisting) {
            $collection->{$config['relation']}()->delete();
        }

        $i = 1;
        foreach ($config['items'] as $item) {
            $collection->{$config['relation']}()->create([
                $config['key'] => $item['id'],
                'sort' => $i++,
            ]);
        }
    }

    public function attachItemsToCollection($createdCollection): void
    {
        $this->saveItemsToCollection($createdCollection);
    }

    public function syncItemsToCollection($collection): void
    {
        $this->saveItemsToCollection($collection, true);
    }

}
