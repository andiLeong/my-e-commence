<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HasAddressCreated
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

        if( !auth()->user()->address()->NonOrder()->exists() ){

            Cache::add('redirect_back_to_checkout','yes', $seconds = 60 * 2);
            return redirect()->route('address.create')
                ->with('need_create_address_before_checkout', 'Please create shipping address before checking out!');
        }

        return $next($request);
    }
}
