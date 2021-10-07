<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id' , 'id');
    }

    public function scopeWithProductsCount($query)
    {
        return $query->addSelect(['product_counts' =>
                    Product::selectRaw('count(id)')
                        ->whereColumn('category_id', 'categories.id')
                        ->limit(1)
        ]);
    }
}
