<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $fa_name
 * @property string $en_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @method static Builder<static>|Role newModelQuery()
 * @method static Builder<static>|Role newQuery()
 * @method static Builder<static>|Role onlyTrashed()
 * @method static Builder<static>|Role query()
 * @method static Builder<static>|Role whereCreatedAt($value)
 * @method static Builder<static>|Role whereDeletedAt($value)
 * @method static Builder<static>|Role whereEnName($value)
 * @method static Builder<static>|Role whereFaName($value)
 * @method static Builder<static>|Role whereId($value)
 * @method static Builder<static>|Role whereUpdatedAt($value)
 * @method static Builder<static>|Role withTrashed()
 * @method static Builder<static>|Role withoutTrashed()
 * @mixin Eloquent
 */
class Role extends Model
{
    use SoftDeletes;

    public const string TABLE_NAME = 'roles';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';

    protected $fillable = [
        'fa_name',
        'en_name',
    ];

    protected $hidden = [];

    protected $casts = [];

    /*------------ Relations ------------*/

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
