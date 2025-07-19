<?php

namespace App\Models;

use App\Enums\PostIsPublish;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;
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
 * @property string $body
 * @property PostIsPublish $is_published
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read string $is_publish_badge_class
 * @property-read string $is_publish_label
 * @property-read string $jalali_created_at
 * @property-read User|null $user
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post onlyTrashed()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereBody($value)
 * @method static Builder<static>|Post whereCategoryId($value)
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereExcerpt($value)
 * @method static Builder<static>|Post whereId($value)
 * @method static Builder<static>|Post whereIsPublished($value)
 * @method static Builder<static>|Post whereSlug($value)
 * @method static Builder<static>|Post whereTitle($value)
 * @method static Builder<static>|Post whereUpdatedAt($value)
 * @method static Builder<static>|Post whereUserId($value)
 * @method static Builder<static>|Post withTrashed()
 * @method static Builder<static>|Post withoutTrashed()
 * @mixin Eloquent
 */
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

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
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

    public function getExcerptAttribute($value): string
    {
        return $value ?? Str::limit(strip_tags($this->body), 200);
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

    public function scopePublished($query)
    {
        return $query->where('is_published', PostIsPublish::Yes);
    }


    public function scopeNotPublished($query)
    {
        return $query->where('is_published', PostIsPublish::No);
    }

    /*---------- Other Functions --------*/

}
