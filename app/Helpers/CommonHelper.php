<?php

use App\Enums\DiscountType;
use Illuminate\Support\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Carbon\Carbon;

function showEnumLabels(string|int $enum): Collection
{
    return collect($enum::cases())->mapWithKeys(fn($status) => [
        $status->label() => $status->value
    ]);
}

function storeImage(TemporaryUploadedFile $image, string $folder): string
{
    $date = Carbon::now();
    $originalPath = 'uploads/images/' . $folder . '/' . $date->year . '/' . $date->month . '/' . $date->day;
    $path = Storage::disk('public')->put($originalPath, $image);
    return '/storage/' . $path;
}

function calculateProductFinalPrice(string|int|DiscountType $discountType, int|string $price, int|string $discount): float|int|string
{
    $price = (int) $price;
    $discount = (int) $discount;

    return match (true) {
        $discountType == DiscountType::Amount || $discountType == DiscountType::Amount->value => $price - $discount,
        $discountType == DiscountType::Percent || $discountType == DiscountType::Percent->value => $price - ($price * $discount / 100),
        default => $price,
    };

}
