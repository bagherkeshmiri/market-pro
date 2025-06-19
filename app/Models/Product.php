<?php

namespace App\Models;

use App\Enums\DiscountType;
use App\Enums\ProductStatus;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;


/**
 *
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property ProductStatus $status  1:not_exist , 2:exist
 * @property DiscountType $discount_type  1:percent , 2:amount
 * @property string|null $description
 * @property string $price
 * @property string $discount
 * @property string $final_price
 * @property int $stock
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read ProductImage|null $galleryImages
 * @property-read string $formatted_price
 * @property-read string $jalali_created_at
 * @property-read string $status_badge_class
 * @property-read string $status_label
 * @property-read Collection<int, ProductImage> $images
 * @property-read int|null $images_count
 * @property-read ProductImage|null $mainImage
 * @property-read Collection<int, OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @method static Builder<static>|Product newModelQuery()
 * @method static Builder<static>|Product newQuery()
 * @method static Builder<static>|Product query()
 * @method static Builder<static>|Product whereCategoryId($value)
 * @method static Builder<static>|Product whereCreatedAt($value)
 * @method static Builder<static>|Product whereDescription($value)
 * @method static Builder<static>|Product whereDiscount($value)
 * @method static Builder<static>|Product whereDiscountType($value)
 * @method static Builder<static>|Product whereId($value)
 * @method static Builder<static>|Product whereName($value)
 * @method static Builder<static>|Product wherePrice($value)
 * @method static Builder<static>|Product whereStatus($value)
 * @method static Builder<static>|Product whereStock($value)
 * @method static Builder<static>|Product whereUpdatedAt($value)
 * @property-read int $discount_percent
 * @property-read string $discount_type_badge_class
 * @property-read string $discount_type_label
 * @property-read string $formatted_discount
 * @property-read string $formatted_final_price
 * @method static Builder<static>|Product whereFinalPrice($value)
 * @mixin Eloquent
 */
class Product extends Eloquent
{
    public const string TABLE_NAME = 'products';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_CATEGORY_ID = 'category_id';

    protected $fillable = [
        'category_id',
        'name',
        'status',
        'description',
        'price',
        'stock',
        'discount_type',
        'discount',
        'final_price',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => ProductStatus::class,
        'discount_type' => DiscountType::class
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('orderByIdDesc', function (Builder $builder) {
            $builder->orderByDesc('id');
        });
    }

    public function getStatusLabelAttribute(): string
    {
        return $this->status->label();
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status->badgeClass();
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price);
    }

    public function getFormattedFinalPriceAttribute(): string
    {
        return number_format($this->final_price);
    }

    public function getFormattedDiscountAttribute(): string
    {
        return $this->discount_type == DiscountType::Amount ? number_format($this->discount) : $this->discount;
    }

    public function getDiscountPercentAttribute(): int
    {
        if ($this->price <= 0) {
            return 0;
        }

        if ($this->discount_type === DiscountType::Percent) {
            return $this->discount;
        }

        if ($this->discount_type === DiscountType::Amount) {
            return round(($this->discount / $this->price) * 100);
        }

        return 0;
    }

    public function getJalaliCreatedAtAttribute(): string
    {
        return Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s');
    }

    public function getDiscountTypeLabelAttribute(): string
    {
        return $this->discount_type->label();
    }

    public function getDiscountTypeBadgeClassAttribute(): string
    {
        return $this->discount_type->badgeClass();
    }


    /*------------ Relations ------------*/

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::COLUMN_CATEGORY_ID, Category::COLUMN_ID);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, ProductImage::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }

    public function galleryImages(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_main', false);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, OrderItem::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(CollectionProduct::class, CollectionProduct::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }


    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
