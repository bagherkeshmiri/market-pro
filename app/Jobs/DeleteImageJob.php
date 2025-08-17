<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Log;
use Str;

class DeleteImageJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected string $address;

    public function __construct(string $address)
    {
        $this->address = $address;
    }

    public function handle(): void
    {
        $disk = app()->isLocal() ? 'public' : 's3';

        if ($disk === 'public') {
            $relativePath = Str::replaceFirst('/storage/', '', $this->address);
        } else {
            $relativePath = $this->address;
        }
        if (Storage::disk($disk)->exists($relativePath)) {
            Storage::disk($disk)->delete($relativePath);
        }
    }

}
