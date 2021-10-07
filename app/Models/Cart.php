<?php
namespace App\Models;

use App\Usecase\CartAdd;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartDecrement;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartIncrement;
use App\Usecase\ShoppingCartQuantityAdjustment\ShoppingCartQuantityAdjustment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;


class Cart extends Model
{
    use HasFactory;

    protected $appends = ['total'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id' , 'id');
    }

    public function scopeWithProduct($query,$product_id)
    {
        $query->where('product_id', $product_id);
    }

    public function scopeCreatedLessThan($query,$days)
    {
        $query->where('created_at' , '<' , $days );
    }

    public static function pickUpByUserWithProduct(model $user, $product_id)
    {
        return $user->carts()->withProduct($product_id)->first();
    }

    public function addBy(Model $user, array $attributes)
    {
        return CartAdd::handle($user,$attributes);
    }

    public function removal()
    {
        return new ShoppingCartRemoval($this);
    }

    public function adjustQuantity(ShoppingCartQuantityAdjustment $handler, $quantity = 1)
    {
        return $handler->handle($this,$quantity);
    }

    /**
     * @param $quantity
     * @param Int $stocks
     * author: andi
     * date:2021/8/22
     */
    protected function createGuarding($quantity, Int $stocks): void
    {
        if ($quantity > $stocks) {
            throw new InvalidArgumentException('product is running out of stocks !');
        }
    }

    public function getTotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }


    public static function clearItem($ids)
    {
        return Cart::whereIn('id',$ids)->delete();
    }
}
