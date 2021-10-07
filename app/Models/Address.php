<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Address extends Model
{
    use HasFactory;

    public const ADDRESS_LIMIT = 5;

    public function scopeNonOrder($query)
    {
        return $query->whereNull('order_id');
    }

    public function addBy(Model $user, array $attributes)
    {
        return $user->address()->create($attributes);
    }
}
