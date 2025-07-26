<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $label
 * @property \App\Enums\IsActive $is_active  0:no 1:yes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $jalali_created_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GateOrg> $org
 * @property-read int|null $org_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gate withoutTrashed()
 */
	class Gate extends \Eloquent {}
}

