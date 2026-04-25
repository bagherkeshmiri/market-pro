<?php

namespace App\Models;

use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $imageable_id
 * @property string $imageable_type
 * @property bool $is_main
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read Model|Eloquent $imageable
 * @method static Builder<static>|Image newModelQuery()
 * @method static Builder<static>|Image newQuery()
 * @method static Builder<static>|Image query()
 * @mixin Eloquent
 */
class Image extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'images';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'url',
        'is_main',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    /*------------ Relations ------------*/

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
