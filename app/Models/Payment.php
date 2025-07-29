<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;
use Str;

/**
 *
 *
 * @property int $id
 * @property int $order_id
 * @property int|null $gate_id
 * @property int|null $gate_org_id
 * @property string $payment_number
 * @property PaymentStatus $status  1:unSuccess , 2:success
 * @property string $amount
 * @property string|null $ref_id
 * @property int|null $paid_at
 * @property int $expire_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Gate|null $gate
 * @property-read GateOrg|null $gateOrg
 * @property-read string $jalali_created_at
 * @property-read Order|null $order
 * @method static Builder<static>|Payment newModelQuery()
 * @method static Builder<static>|Payment newQuery()
 * @method static Builder<static>|Payment onlyTrashed()
 * @method static Builder<static>|Payment query()
 * @method static Builder<static>|Payment whereAmount($value)
 * @method static Builder<static>|Payment whereCreatedAt($value)
 * @method static Builder<static>|Payment whereExpireTime($value)
 * @method static Builder<static>|Payment whereGateId($value)
 * @method static Builder<static>|Payment whereGateOrgId($value)
 * @method static Builder<static>|Payment whereId($value)
 * @method static Builder<static>|Payment whereOrderId($value)
 * @method static Builder<static>|Payment wherePaidAt($value)
 * @method static Builder<static>|Payment wherePaymentNumber($value)
 * @method static Builder<static>|Payment whereRefId($value)
 * @method static Builder<static>|Payment whereStatus($value)
 * @method static Builder<static>|Payment whereUpdatedAt($value)
 * @method static Builder<static>|Payment withTrashed()
 * @method static Builder<static>|Payment withoutTrashed()
 * @mixin Eloquent
 */
class Payment extends Authenticatable
{
    public const string TABLE_NAME = 'payments';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_ORDER_ID = 'order_id';
    public const string COLUMN_GATE_ID = 'gate_id';
    public const string COLUMN_GATE_ORG_ID = 'gate_org_id';

    protected $fillable = [
        'order_id',
        'gate_id',
        'gate_org_id',
        'payment_number',
        'status',
        'amount',
        'ref_id',
        'paid_at',
        'expire_time',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => PaymentStatus::class,
        'paid_at' => 'timestamp',
        'expire_time' => 'timestamp',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });

        static::creating(function ($payment) {
            $payment->payment_number = self::generateUniqueTrackingCode();
        });

        static::creating(function ($payment) {
            if (empty($payment->expire_time)) {
                $payment->expire_time = Carbon::now()->addMinutes(15);
            }
        });

    }

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }

    /*------------ Relations ------------*/

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, self::COLUMN_ORDER_ID, Order::COLUMN_ID);
    }

    public function gate(): BelongsTo
    {
        return $this->belongsTo(Gate::class, self::COLUMN_GATE_ID, Gate::COLUMN_ID);
    }

    public function gateOrg(): BelongsTo
    {
        return $this->belongsTo(GateOrg::class, self::COLUMN_GATE_ORG_ID, GateOrg::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

    protected static function generateUniqueTrackingCode(): string
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (self::where('payment_number', $code)->exists());

        return $code;
    }
}
