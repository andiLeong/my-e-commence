<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    use TimeFrameScopes;

    protected $appends = ['short_order_number'];

    public static $orderAttributes = [
        'payment_method' => 'card',
        'payment_vendor' => 'stripe',
        'status' => 'paid',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_number = Str::random(40);
        });
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeSumupSalesGroupByYearMonth($query)
    {
        return $query->select(
                DB::raw("CONCAT_WS('-',YEAR(created_at),MONTH(created_at)) as `year_month`"),
                DB::raw('count(id) as `count`'),
                DB::raw('sum(total_price) as `sum_up`'),
            )
            ->groupby('year_month');
    }

    public function scopeWithOrderTotalPrice($query)
    {
        return $query->addSelect(['order_total_price' =>
            OrderProduct::query()
                ->selectRaw('sum(total_price)')
                ->whereColumn('order_id', 'orders.id')
                ->limit(1)
        ]);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class,'order_id','id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_products',);
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Address::class,'order_id','id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getShortOrderNumberAttribute()
    {
        return Str::substr( $this->order_number  , 1 , 20 );
    }

    public function stripeTransactions(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(StripeOrderTransaction::class,'order_id','id');
    }

    public function paypalTransactions(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PaypalOrderTransaction::class,'order_id','id');
    }

    public function setRefunded($status)
    {
        return $this->update(['status' => $status]);
    }

    public function recordProducts(Product $product,$quantity)
    {
        $this->products()->attach($product,[
            'product_name' => $product->name,
            'product_price' => $product->price,
            'product_description' => $product->description,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
        ]);
        $product->stockDecrease($quantity);
    }

    public function updateTotalPrice($amount)
    {
        return $this->update(['total_price' => $amount]);
    }

}
