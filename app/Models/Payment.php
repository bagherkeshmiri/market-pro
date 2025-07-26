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


class Payment extends Authenticatable
{
    use SoftDeletes;

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
    }

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }

    protected static function generateUniqueTrackingCode(): string
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (self::where('payment_number', $code)->exists());

        return $code;
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

}
