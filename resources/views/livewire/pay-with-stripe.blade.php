

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

        {{--  credit card process form --}}
        <form id="payment-form" >
            <div id="card-element">
                <!-- Elements will create input elements here -->
            </div>

            <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert" class="text-red-500 italic text-sm"></div>

            <div class="mt-10">
                <button id="submit"
                        class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 uppercase justify-center"
                >
                    <x-svg.spin class="hidden text-white" id="spinner"/>
                    Pay
                </button>
            </div>
        </form>

        <x-alert id="alert" class="hidden">
            Processing payment . Please DO NOT close browser
        </x-alert>

        <div id="payment-fail" class="bg-red-200 rounded py-2 mt-2 px-3 text-red-700 font-medium hidden "></div>

        <script src="https://js.stripe.com/v3/"></script>
        <script>

            var stripe = Stripe('pk_test_51JfkVOIZblOMSJ59X1WoyP1jHmjyichQ2Wr0npjIGqOrLGtJqX9EpmldYfbYC5iIsP1VDCimuzg11ksHijBPZPKA00hHFEemMt');
            var elements = stripe.elements();

            var style = {
                base: {
                    color: '#303238',
                    fontSize: '16px',
                    fontFamily: '"Open Sans", sans-serif',
                    fontSmoothing: 'antialiased',
                    '::placeholder': {
                        color: '#CFD7DF',
                    },
                },
                invalid: {
                    color: '#e5424d',
                    ':focus': {
                        color: '#303238',
                    },
                },
            };

            var card = elements.create("card", { style: style });
            card.mount("#card-element");

            card.on('change', ({error}) => {
                let displayError = document.getElementById('card-errors');
                if (error) {
                    displayError.textContent = error.message;
                } else {
                    displayError.textContent = '';
                }
            });


            var form = document.getElementById('payment-form');
            var spinner = document.getElementById("spinner");
            var alertElement = document.getElementById("alert");
            var paymentFail = document.getElementById("payment-fail");

            form.addEventListener('submit', function(ev) {
                ev.preventDefault();
                spinner.classList.remove("hidden");
                alertElement.classList.remove("hidden");

                stripe.confirmCardPayment('{{$paymentIntentSecret}}', {
                    payment_method: {
                        card: card,
                        billing_details: {
                            name: '@user_name'
                        }
                    }
                }).then(function(result) {
                    if (result.error) {
                        spinner.classList.add("hidden");
                        alertElement.classList.add("hidden");
                        paymentFail.classList.remove("hidden");
                        paymentFail.innerHTML = result.error.message;
                        console.log(result.error.message);
                    } else {
                        // The payment has been processed!
                        if (result.paymentIntent.status === 'succeeded') {

                            console.log('stripe callback success');
                            let transaction_id = result.paymentIntent.id;
                            let payment_intent = '{{$paymentIntentSecret}}';
                            @this.createOrder(transaction_id,payment_intent);
                            console.log(result);

                            spinner.classList.add("hidden");
                            alertElement.classList.add("hidden");
                        }
                    }
                });

            });
        </script>

    </x-slot>
</x-home.checkout-layout>

