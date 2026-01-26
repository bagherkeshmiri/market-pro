<?php

use App\Enums\DiscountType;
use App\Models\SystemSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Carbon\Carbon;

function showEnumLabels(string|int $enum): Collection
{
    return collect($enum::cases())->mapWithKeys(fn($status) => [
        $status->label() => $status->value
    ]);
}

/**
 * @throws Exception
 */
function storeImage(TemporaryUploadedFile|UploadedFile $image, string $folder): string
{
    $date = Carbon::now();
    $originalPath = 'uploads/images/' . $folder . '/' . $date->year . '/' . $date->month . '/' . $date->day;

    $disk = app()->isLocal() ? 'public' : 's3';

    $filename = uniqid() . '.webp';
    $mime = $image->getMimeType();

    switch ($mime) {
        case 'image/jpeg':
        case 'image/jpg':
            $imgResource = imagecreatefromjpeg($image->getPathname());
            break;
        case 'image/png':
            $imgResource = imagecreatefrompng($image->getPathname());
            $newImage = imagecreatetruecolor(imagesx($imgResource), imagesy($imgResource));
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            imagecopy($newImage, $imgResource, 0, 0, 0, 0, imagesx($imgResource), imagesy($imgResource));
            imagedestroy($imgResource);
            $imgResource = $newImage;
            break;
        default:
            throw new Exception('فرمت فایل پشتیبانی نمی‌شود.');
    }

    ob_start();
    imagewebp($imgResource, null, 100);
    $webpData = ob_get_clean();

    imagedestroy($imgResource);

    $fullPath = $originalPath . '/' . $filename;
    if ($disk === 'public') {
        Storage::disk('public')->put($fullPath, $webpData);
        return '/storage/' . $fullPath;
    } else {
        Storage::disk('s3')->put($fullPath, $webpData, 'public');
        return Storage::disk('s3')->url($fullPath);
    }
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



function getSystemSetting($key, $default = null)
{
    return cache()->rememberForever("setting_{$key}", function () use ($key, $default) {
        return SystemSetting::where('key', $key)->value('value') ?? $default;
    });
}

