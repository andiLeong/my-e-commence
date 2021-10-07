<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class test
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//        \DB::listen(function ($query){
//    logger($query->sql);
////    logger($query->bindings);
//});


        $product = Product::find($request['product_id']);


        if(!$product){
            abort(404);
        }
        return $next($request);
    }
}
