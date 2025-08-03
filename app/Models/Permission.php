<?php

namespace App\Models;

use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;


/**
 *
 *
 * @property int $id
 * @property string $fa_name
 * @property string $en_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @method static Builder<static>|Permission newModelQuery()
 * @method static Builder<static>|Permission newQuery()
 * @method static Builder<static>|Permission query()
 * @method static Builder<static>|Permission whereCreatedAt($value)
 * @method static Builder<static>|Permission whereDeletedAt($value)
 * @method static Builder<static>|Permission whereEnName($value)
 * @method static Builder<static>|Permission whereFaName($value)
 * @method static Builder<static>|Permission whereId($value)
 * @method static Builder<static>|Permission whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Permission extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'permissions';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'fa_name',
        'en_name',
    ];

    protected $hidden = [];

    protected $casts = [];

    /*------------ Relations ------------*/

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    /*-------------- Accessors & Mutators -------------*/

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
