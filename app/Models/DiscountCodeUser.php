<?php

namespace App\Models;

use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;

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
