<?php
namespace Tests;


trait GetCartAttributes
{

    private function getAddToCartAttributes($product,$quantity)
    {
        return [
            'quantity' => $quantity,
            'product_id' => $product->id,
//            'price' => $product->price,
//            'total_price' => $product->price * $quantity,
//            'product_name' => $product->name,
//            'product_description' => $product->description,
        ];
    }

}
