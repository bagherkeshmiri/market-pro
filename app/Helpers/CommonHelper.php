<?php

use App\Enums\UserType;
use Illuminate\Support\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

function jalali($date = null, string $format = 'Y/m/d H:i:s'): ?string
{
    if (!$date) {
        return null;
    }

    if (is_string($date)) {
        $date = Carbon::parse($date);
    }

    return Jalalian::fromCarbon($date)->format($format);
}

function showEnumLabels(string|int $enum): Collection
{
    return collect($enum::cases())->mapWithKeys(fn($status) => [
        $status->label() => $status->value
    ]);
}

function convertUserTypeToString(UserType $type): string
{
    return match ($type) {
        UserType::User => 'کاربر',
        UserType::Admin => 'مدیر',
    };
}


function storeImage(TemporaryUploadedFile $image, string $folder): string
{
    $date = Carbon::now();
    $originalPath = 'uploads/images/' . $folder . '/' . $date->year . '/' . $date->week . '/' . $date->day;
    $path = Storage::disk('public')->put($originalPath, $image);
    return '/storage/' . $path;
}
