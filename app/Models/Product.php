<?php

namespace App\Models;

use App\Casts\Money;
use App\QueryFilters\CategoryId;
use App\QueryFilters\Name;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;



    protected $casts = [
        'on_sale' => 'boolean',
        'price' => Money::class,
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function scopeOnSale($query)
    {
        return $query->where('on_sale',true);
    }

    public function scopeSlug($query,$slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeWithShoppingCart($query,$user_id)
    {
        return $query->addSelect(['added_to_cart' => Cart::query()
            ->select('id')
            ->whereColumn('product_id', 'products.id')
            ->where('user_id', $user_id)
            ->limit(1)
        ]);
    }


    public function scopeFilter($builder,$data)
    {
        if(!empty($data)){

            $data['builder'] = $builder;
            $pipeline = app(Pipeline::class)
                ->send($data)
                ->through([Name::class, CategoryId::class,])
                ->thenReturn();

            return $pipeline Instanceof \Illuminate\Database\Eloquent\Builder
                ? $pipeline
                : $pipeline['builder'];
        }
        return $builder;
    }

    public function getCoverAttribute($value)
    {
        return is_null($value)
            ? "https://tailwindui.com/img/ecommerce-images/shopping-cart-page-01-product-01.jpg"
            : Storage::disk('digitalocean')->url($value);
    }

    public function getShortDescriptionAttribute()
    {
        return Str::words($this->description, 10, '......');
    }

    public static function store($attributes, array $paths)
    {
        return tap(self::create($attributes), fn($product) =>
            Image::persist($paths, $product)
        );
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }


    public function stockDecrease($quantity)
    {
        return $this->decrement('stocks', $quantity);
    }

    public function stockIncrease($quantity)
    {
        return $this->increment('stocks', $quantity);
    }

    public function inStock($quanity)
    {
        return $this->stocks >= $quanity;
    }
}
