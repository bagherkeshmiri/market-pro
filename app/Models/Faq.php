<?php

namespace App\Models;

use App\Enums\IsActive;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property IsActive $is_active  0:no , 1:yes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $is_active_badge_class
 * @property-read string $is_active_label
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @method static Builder<static>|Faq newModelQuery()
 * @method static Builder<static>|Faq newQuery()
 * @method static Builder<static>|Faq query()
 * @method static Builder<static>|Faq whereAnswer($value)
 * @method static Builder<static>|Faq whereCreatedAt($value)
 * @method static Builder<static>|Faq whereId($value)
 * @method static Builder<static>|Faq whereIsActive($value)
 * @method static Builder<static>|Faq whereQuestion($value)
 * @method static Builder<static>|Faq whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Faq extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'faqs';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];

    protected $hidden = [];

    protected $casts = [
        'is_active' => IsActive::class,
    ];

    /*------------ Relations ------------*/

    /*-------------- Accessors & Mutators -------------*/

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active->label();
    }

    public function getIsActiveBadgeClassAttribute(): string
    {
        return $this->is_active->badgeClass();
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
