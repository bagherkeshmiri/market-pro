<?php

namespace App\Traits;

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

    public function attachItemsToCollection($createdCollection): void
    {
        $map = $this->getCollectionMap();
        $typeKey = $this->getTypeKey();

        if (isset($map[$typeKey])) {
            $config = $map[$typeKey];
            $i = 1;
            foreach ($config['items'] as $item) {
                $createdCollection->{$config['relation']}()->create([
                    $config['key'] => $item['id'],
                    'sort' => $i++,
                ]);
            }
        }
    }

    public function syncItemsToCollection($collection): void
    {
        $map = $this->getCollectionMap();
        $typeKey = $this->getTypeKey();

        if (isset($map[$typeKey])) {
            $config = $map[$typeKey];
            $collection->{$config['relation']}()->delete();

            $i = 1;
            foreach ($config['items'] as $item) {
                $collection->{$config['relation']}()->create([
                    $config['key'] => $item['id'],
                    'sort' => $i++,
                ]);
            }
        }
    }
}
