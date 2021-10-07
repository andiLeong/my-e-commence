<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderProduct extends Model
{
    use HasFactory;
    use TimeFrameScopes;

    public array $cartData;

    /**
     * @param $carts
     * @param $order
     * @return mixed
     * author: andi
     * date:2021/10/7
     */
    public function parseCartDataToArray($carts, $order)
    {
        $this->cartData = $carts->map(function ($item) use ($order) {
            $data['product_description'] = $item->product->description;
            $data['product_name'] = $item->product->name;
            $data['cover'] = $item->product->cover;
            $data['total_price'] = $item->product->price * $item->quantity;
            $data['product_price'] = $item->product->price;
            $data['product_id'] = $item->product_id;
            $data['quantity'] = $item->quantity;
            $data['order_id'] = $order->id;
            $data['created_at'] = $data['updated_at'] = now();
            return $data;
        })->toArray();
        return $this;
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id' , 'id');
    }


    public function insertFromCart()
    {
        return OrderProduct::insert($this->cartData);
    }

}
