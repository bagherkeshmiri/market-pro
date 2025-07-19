<?php

namespace App\Models;

use App\Enums\IsActive;
use App\Enums\PostIsPublish;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

class Post extends Eloquent
{
    use SoftDeletes;

    public const string TABLE_NAME = 'posts';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_USER_ID = 'user_id';
    public const string COLUMN_CATEGORY_ID = 'category_id';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'is_published',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_published' => PostIsPublish::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }


    public function getIsPublishLabelAttribute(): string
    {
        return $this->is_published->label();
    }

    public function getIsPublishBadgeClassAttribute(): string
    {
        return $this->is_published->badgeClass();
    }

    /*------------ Relations ------------*/

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COLUMN_USER_ID, User::COLUMN_ID);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::COLUMN_CATEGORY_ID, Category::COLUMN_ID);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
