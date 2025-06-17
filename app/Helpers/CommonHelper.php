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
    if ($discountType == DiscountType::Amount->value) {
        $finalPrice = (int)$price - $discount;
    } elseif ($discountType == DiscountType::Percent->value) {
        $finalPrice = (int)$price - ((int)$price * (int)$discount / 100);
    } else {
        $finalPrice = (int)$price;
    }
    return $finalPrice;
}
