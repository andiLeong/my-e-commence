<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustHaveCart
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
        if( auth()->user()->carts()->count() == 0 ){
            abort(403, 'Please add items to your cart before check out', );
        }

        return $next($request);
    }
}
