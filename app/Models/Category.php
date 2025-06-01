<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    public const string TABLE_NAME = 'categories';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_PARENT_ID = 'parent_id';

    protected $fillable = [
        'name',
        'parent_id',
    ];

    protected $hidden = [];

    protected $casts = [];

    /*------------ Relations ------------*/

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::COLUMN_PARENT_ID, self::COLUMN_ID);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, Product::COLUMN_CATEGORY_ID, self::COLUMN_ID);
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
