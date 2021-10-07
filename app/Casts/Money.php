<?php
namespace App\Casts;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Money implements CastsAttributes
{

    public function get($model, string $key, $value, array $attributes)
    {
        return $value / 100 ;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return round($value * 100 , 2);
    }
}
