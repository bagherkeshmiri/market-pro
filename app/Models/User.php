<?php

namespace App\Models;

use App\Enums\UserType;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 *
 *
 * @property int $id
 * @property int $role_id
 * @property UserType $type  1 : user , 2 : admin
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Role|null $role
 * @method static Builder<static>|User isAdmin()
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereEmailVerifiedAt($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereName($value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User whereRememberToken($value)
 * @method static Builder<static>|User whereRoleId($value)
 * @method static Builder<static>|User whereType($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    public const string TABLE_NAME = 'users';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_ROLE_ID = 'role_id';

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'type' => UserType::class,
    ];

    /*------------ Relations ------------*/

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, self::COLUMN_ROLE_ID, Role::COLUMN_ID);
    }

    public function permissions()
    {
        return $this->role?->permissions() ?? collect();
    }

    /*-------------- Scopes -------------*/

    public function scopeIsAdmin(Builder $query): Builder
    {
        return $query->where('type', UserType::Admin);
    }

    /*---------- Other Functions --------*/

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function hasPermissionByName(string $enName): bool
    {
        return optional($this->role)
            ->permissions
            ->contains('en_name', $enName);
    }


}
