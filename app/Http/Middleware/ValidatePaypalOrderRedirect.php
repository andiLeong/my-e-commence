<?php

namespace App\Http\Middleware;

use App\PaymentGateway\PaypalGateway;
use Closure;
use Illuminate\Http\Request;

class ValidatePaypalOrderRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param \App\PaymentGateway\PaypalGateway $paypal
     * @return mixed
     */
    public function handle(Request $request, Closure $next )
    {
        $requestData = $request->all();
        if( $requestData['payment_method'] == 'paypal'  ){
            abort_if( !$request->has(['transaction_id','redirect_status','paypal_order_id']) , 403 , 'need paypal transaction id to continue!');


            $paypal = resolve(PaypalGateway::class);
            $response = $paypal->retrieveOrder(  $requestData['paypal_order_id'] );
            if(   $response->statusCode == '200' && $response->result->status == 'COMPLETED'){
                return $next($request);
            }

            return abort(403,'cant connect to paypal server');

        }

        return $next($request);
    }
}
