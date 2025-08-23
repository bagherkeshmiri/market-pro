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

    $disk = app()->isLocal() ? 'public' : 's3';

    $path = Storage::disk($disk)->put($originalPath, $image);

    if ($disk === 'public') {
        return '/storage/' . $path;
    }

    return Storage::disk('s3')->url($path);
}

function calculateProductFinalPrice(
    string|int|DiscountType $discountType,
    int|string $price,
    int|string $discount
): float|int|string {
    $price = (int)$price;
    $discount = (int)$discount;

    return match (true) {
        $discountType == DiscountType::Amount || $discountType == DiscountType::Amount->value => $price - $discount,
        $discountType == DiscountType::Percent || $discountType == DiscountType::Percent->value => $price - ($price * $discount / 100),
        default => $price,
    };
}

function isActiveRoute($routes, $class = 'active')
{
    foreach ((array)$routes as $route) {
        if (request()->routeIs($route)) {
            return $class;
        }
    }
    return '';
}

function isActiveUrl($patterns, $class = 'active')
{
    foreach ((array)$patterns as $pattern) {
        if (request()->is($pattern)) {
            return $class;
        }
    }
    return '';
}
