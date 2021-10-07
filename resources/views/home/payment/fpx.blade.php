
<x-home-layout>


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

        {{--  fpx process form --}}
        <form id="payment-form">
            <div class="form-row">
                <div>
                    <label for="fpx-bank-element">
                        FPX Bank
                    </label>
                    <div id="fpx-bank-element" class="mt-5">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>
                </div>
            </div>


            <div class="mt-10">
                <button id="fpx-button" data-secret="{{ $paymentIntentSecret }}"
                        class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 uppercase justify-center"
                >
                    <x-svg.spin class="hidden text-white" id="spinner"/>
                    Pay
                </button>
            </div>

            <!-- Used to display form errors. -->
            <div id="error-message" role="alert"></div>
        </form>

        <x-alert id="alert" class="hidden">
            Processing payment . Please DO NOT close browser
        </x-alert>

        <div id="payment-fail" class="bg-red-200 rounded py-2 mt-2 px-3 text-red-700 font-medium hidden "></div>

        <script src="https://js.stripe.com/v3/"></script>
        <script>

            let redirectUrl = "{{url('')}}" + "/orders/success?address_id={{$address_id}}&payment_method=fpx";
            console.log(redirectUrl);
            var stripe = Stripe('pk_test_51JfkVOIZblOMSJ59X1WoyP1jHmjyichQ2Wr0npjIGqOrLGtJqX9EpmldYfbYC5iIsP1VDCimuzg11ksHijBPZPKA00hHFEemMt');
            var elements = stripe.elements();

            var style = {
                base: {
                    // Add your base input styles here. For example:
                    padding: '10px 12px',
                    color: '#32325d',
                    fontSize: '16px',
                },
            };

            // Create an instance of the fpxBank Element.
            var fpxBank = elements.create(
                'fpxBank',
                {
                    style: style,
                    accountHolderType: 'individual',
                }
            );

            // Add an instance of the fpxBank Element into the container with id `fpx-bank-element`.
            fpxBank.mount('#fpx-bank-element');
            var form = document.getElementById('payment-form');
            var spinner = document.getElementById("spinner");
            var alertElement = document.getElementById("alert");

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                spinner.classList.remove("hidden");
                alertElement.classList.remove("hidden");

                var fpxButton = document.getElementById('fpx-button');
                var clientSecret = fpxButton.dataset.secret;
                stripe.confirmFpxPayment(clientSecret, {
                    payment_method: {
                        fpx: fpxBank,
                    },

                    return_url: redirectUrl,
                }).then((result) => {
                    if (result.error) {
                        // Inform the customer that there was an error.
                        // var errorElement = document.getElementById('error-message');

                        spinner.classList.add("hidden");
                        alertElement.classList.add("hidden");
                        paymentFail.classList.remove("hidden");
                        paymentFail.innerHTML = result.error.message;
                        console.log(result.error.message);

                        // errorElement.textContent = result.error.message;
                    }
                });
            });

        </script>

    </x-slot>
</x-home.checkout-layout>

</x-home-layout>
