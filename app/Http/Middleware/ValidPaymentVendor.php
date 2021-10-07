<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidPaymentVendor
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
        $requestData = $request->all();
        abort_if( !$request->has('address_id') , 403 , 'need address to proceed !');
        abort_if( !isset($requestData['payment_method']) , 403 , 'vendor not support !');
        abort_if( !in_array($requestData['payment_method'],['fpx','stripe','paypal'] ) , 403 , 'payment method not support');


        if( $requestData['payment_method'] == 'fpx' || $requestData['payment_method'] == 'stripe'  ){
            abort_if( !$request->has(['payment_intent', 'payment_intent_client_secret','redirect_status']) , 403 , 'vendor doesn\'t set parameter right');
        }

        if(  request('payment_method') == 'fpx' && request('redirect_status')  == 'failed'){

            abort(403, 'Payment fails , please contact customer service');
        }

        return $next($request);
    }
}
