


<x-home-layout>

    <script src="https://www.paypal.com/sdk/js?client-id=AV_JX-GglgPbW8T3YnVXcU4gg3v368k9xDTL9d-DYfJ75GIH1Qh2lx3IHnJTGMKl76osLbjZTuSPwXlB&currency=USD"></script>
    <x-home.checkout-layout>

        <x-slot name="orderSummary">
            <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

            <ul role="list" class="text-sm font-medium text-gray-900 divide-y divide-gray-200">
                @foreach($carts as $cart)
                    <li class="flex items-start py-6 space-x-4">
                        <img src="{{$cart->product->cover}}" alt="{{$cart->product->name}}" class="flex-none w-20 h-20 rounded-md object-center object-cover">
                        <div class="flex-auto space-y-1">
                            <h3>{{$cart->product->name}}</h3>
                            <p class="text-gray-500">{{$cart->product->category->name}}</p>
                            <p class="text-gray-500">{{$cart->quantity}}</p>
                        </div>
                        <p class="flex-none text-base font-medium">${{$cart->product->price}}</p>
                    </li>
                @endforeach
            </ul>

            <dl class="hidden text-sm font-medium text-gray-900 space-y-6 border-t border-gray-200 pt-6 lg:block">
                <div class="flex items-center justify-between pt-6">
                    <dt class="text-base">Total</dt>
                    <dd class="text-base">$ {{$carts_total_price}} </dd>
                </div>
            </dl>
        </x-slot>

        <x-slot name="slot">

            {{--  paypal process form --}}
            <div id="paypal-button-container"></div>
            <div id="payment-fail" class="bg-red-200 rounded py-2 mt-2 px-3 text-red-700 font-medium hidden "></div>


            <x-alert id="alert" class="hidden">
                Processing payment . Please DO NOT close browser
            </x-alert>


            <script>
                paypal.Buttons({

                    // Sets up the transaction when a payment button is clicked
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '{{$carts_total_price}}'
                                }
                            }]
                        });
                    },

                    // Finalize the transaction after payer approval
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(orderData) {
                            // Successful capture! For dev/demo purposes:
                            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                            var transaction = orderData.purchase_units[0].payments.captures[0];

                            let transactionId = transaction.id;
                            let orderId = orderData.id;

                            console.log(orderData);
                            console.log('transaction id : ' + transaction.id);
                            console.log(transaction.status);
                            console.log('order id : ' + orderId);

                            let redirectUrl = "{{url('')}}" + `/orders/success?address_id={{$address_id}}&payment_method=paypal&transaction_id=${transactionId}&redirect_status=completed&paypal_order_id=${orderId}`;
                            console.log(redirectUrl);

                            let paymentFail = document.getElementById("payment-fail");
                            let alertElement = document.getElementById("alert");

                            alertElement.classList.remove("hidden");

                            if( transaction.status === 'COMPLETED'){
                                //redirect
                                window.location.replace(redirectUrl);
                            }else{
                                paymentFail.classList.remove("hidden");
                                paymentFail.innerHTML = 'transaction status is ' + transaction.status + ' please contact customer support. with transaction id' + transactionId;
                            }

                        });
                    }
                }).render('#paypal-button-container');

            </script>

        </x-slot>
    </x-home.checkout-layout>

</x-home-layout>
