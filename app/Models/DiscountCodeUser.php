<?php

namespace App\Models;

use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $discount_code_id
 * @property Carbon $used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DiscountCode $discountCode
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read User $user
 * @method static Builder<static>|DiscountCodeUser newModelQuery()
 * @method static Builder<static>|DiscountCodeUser newQuery()
 * @method static Builder<static>|DiscountCodeUser query()
 * @mixin Eloquent
 */
class DiscountCodeUser extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'discount_code_user';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_USER_ID = 'user_id';
    public const string COLUMN_DISCOUNT_CODE_ID = 'discount_code_id';

    protected $fillable = [
        'user_id',
        'discount_code_id',
    ];

    protected $hidden = [];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    /*------------ Relations ------------*/

    public function discountCode(): BelongsTo
    {
        return $this->belongsTo(DiscountCode::class, self::COLUMN_DISCOUNT_CODE_ID, DiscountCode::COLUMN_ID);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::COLUMN_USER_ID, User::COLUMN_ID);
    }

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
