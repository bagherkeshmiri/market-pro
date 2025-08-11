<?php

namespace App\Models;

use App\Casts\CleanHtml;
use App\Enums\IsActive;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Str;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $slug
 * @property string|null $excerpt
 * @property $body
 * @property IsActive $status  0:not_active , 1:active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read string $status_badge_class
 * @property-read string $status_label
 * @property-read Image|null $image
 * @property-read User|null $user
 * @method static Builder<static>|Post iSActive()
 * @method static Builder<static>|Post isNotActive()
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereBody($value)
 * @method static Builder<static>|Post whereCategoryId($value)
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereExcerpt($value)
 * @method static Builder<static>|Post whereId($value)
 * @method static Builder<static>|Post whereSlug($value)
 * @method static Builder<static>|Post whereStatus($value)
 * @method static Builder<static>|Post whereTitle($value)
 * @method static Builder<static>|Post whereUpdatedAt($value)
 * @method static Builder<static>|Post whereUserId($value)
 * @mixin Eloquent
 */
class Post extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

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
        'status',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => IsActive::class,
        'body' => CleanHtml::class,
    ];

    protected static function booted(): void
    {
        static::creating(function ($post) {
            $post->excerpt = Str::limit(strip_tags($post->body), 200);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /*-------------- Accessors & Mutators -------------*/

    public function getStatusLabelAttribute(): string
    {
        return $this->status->label();
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status->badgeClass();
    }

    /*-------------- Scopes -------------*/

    public function scopeISActive($query)
    {
        return $query->where('status', IsActive::Yes);
    }

    public function scopeIsNotActive($query)
    {
        return $query->where('status', IsActive::No);
    }

    /*---------- Other Functions --------*/

}
