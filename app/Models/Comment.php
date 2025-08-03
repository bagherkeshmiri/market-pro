<?php

namespace App\Models;

use App\Enums\CommentStatus;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $commentable_id
 * @property string|null $commentable_type
 * @property CommentStatus $status  1:pending , 2:approved , 3:rejected
 * @property string $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Model|Eloquent|null $commentable
 * @property-read string $commentable_type_badge_class
 * @property-read string $commentable_type_label
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read string $status_badge_class
 * @property-read string $status_label
 * @property-read User|null $user
 * @method static Builder<static>|Comment newModelQuery()
 * @method static Builder<static>|Comment newQuery()
 * @method static Builder<static>|Comment query()
 * @method static Builder<static>|Comment whereBody($value)
 * @method static Builder<static>|Comment whereCommentableId($value)
 * @method static Builder<static>|Comment whereCommentableType($value)
 * @method static Builder<static>|Comment whereCreatedAt($value)
 * @method static Builder<static>|Comment whereId($value)
 * @method static Builder<static>|Comment whereStatus($value)
 * @method static Builder<static>|Comment whereUpdatedAt($value)
 * @method static Builder<static>|Comment whereUserId($value)
 * @mixin Eloquent
 */
class Comment extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'comments';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_USER_ID = 'user_id';

    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'status',
        'body',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => CommentStatus::class,
    ];

    /*------------ Relations ------------*/

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COLUMN_USER_ID, User::COLUMN_ID);
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

    public function getCommentableTypeLabelAttribute(): string
    {
        return match ($this->commentable_type) {
            Product::class => 'محصول',
            Category::class => 'دسته‌بندی',
            Post::class => 'پست',
            default => 'نامشخص',
        };
    }

    public function getCommentableTypeBadgeClassAttribute(): string
    {
        return match ($this->commentable_type) {
            Product::class => 'bg-rgba-info text-info',
            Category::class => 'bg-rgba-success text-success',
            Post::class => 'bg-rgba-warning text-warning',
            default => 'bg-rgba-danger text-danger',
        };
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
