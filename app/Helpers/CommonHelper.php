<?php

use App\Enums\DiscountType;
use App\Models\Product;
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

function calculateProductFinalPrice(DiscountType $discountType, int|float $price, int $discount): float|int|string
{
    if ($discountType === DiscountType::Amount) {
        $finalPrice = $price - $discount;
    } elseif ($discountType === DiscountType::Percent) {
        $finalPrice = $price - ($price * $discount / 100);
    } else {
        $finalPrice = $price;
    }

    return $finalPrice;
}
