<?php

namespace App\Models;

use App\Casts\CleanHtml;
use App\Enums\DiscountType;
use App\Enums\IsActive;
use App\Enums\ProductStatus;
use App\Traits\HasDefaultOrdering;
use App\Traits\HasJalaliTimestamps;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property int $is_active
 * @property ProductStatus $status
 * @property DiscountType $discount_type
 * @property int $price
 * @property int $discount
 * @property int $final_price
 * @property int $stock
 * @property $long_description
 * @property $short_description
 * @property $additional_information
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category|null $category
 * @property-read Collection<int, CollectionProduct> $collections
 * @property-read Collection<int, Comment> $comments
 * @property-read Collection<int, Image> $galleryImages
 * @property-read int $discount_percent
 * @property-read string $discount_type_badge_class
 * @property-read string $discount_type_label
 * @property-read string $formatted_discount
 * @property-read string $formatted_final_price
 * @property-read string $formatted_price
 * @property-read string $jalali_created_at
 * @property-read string $jalali_updated_at
 * @property-read string $status_badge_class
 * @property-read string $status_label
 * @property-read Collection<int, Image> $images
 * @property-read Image|null $mainImage
 * @property-read Collection<int, OrderItem> $orderItems
 * @method static Builder<static>|Product newModelQuery()
 * @method static Builder<static>|Product newQuery()
 * @method static Builder<static>|Product query()
 * @mixin Eloquent
 */
class Product extends Eloquent
{
    use HasJalaliTimestamps;
    use HasDefaultOrdering;

    public const string TABLE_NAME = 'products';
    protected $table = self::TABLE_NAME;
    public const string COLUMN_ID = 'id';
    public const string COLUMN_CATEGORY_ID = 'category_id';

    protected $fillable = [
        'category_id',
        'name',
        'status',
        'price',
        'stock',
        'discount_type',
        'discount',
        'final_price',
        'long_description',
        'short_description',
        'additional_information',
        'is_active',
    ];

    protected $hidden = [];

    protected $casts = [
        'status' => ProductStatus::class,
        'discount_type' => DiscountType::class,
        'long_description' => CleanHtml::class,
        'short_description' => CleanHtml::class,
        'additional_information' => CleanHtml::class,
        'is_active' => IsActive::class,
    ];

    /*------------ Relations ------------*/

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::COLUMN_CATEGORY_ID, Category::COLUMN_ID);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function mainImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_main', true);
    }

    public function galleryImages(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable')->where('is_main', false);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, OrderItem::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(CollectionProduct::class, CollectionProduct::COLUMN_PRODUCT_ID, self::COLUMN_ID);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /*-------------- Accessors & Mutators -------------*/

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

    public function getDiscountTypeLabelAttribute(): string
    {
        return $this->discount_type->label();
    }

    public function getDiscountTypeBadgeClassAttribute(): string
    {
        return $this->discount_type->badgeClass();
    }

    /*-------------- Scopes -------------*/

    /*---------- Other Functions --------*/

}
