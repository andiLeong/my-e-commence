


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

        {{-- mobile --}}
        <div x-data="{show:true}" class="fixed bottom-0 inset-x-0 flex flex-col-reverse text-sm font-medium text-gray-900 lg:hidden">
            <div class="relative z-10 bg-white border-t border-gray-200 px-4 sm:px-6">
                <div class="max-w-lg mx-auto">
                    <button @click="show = !show" type="button" class="w-full flex items-center py-6 font-medium" aria-expanded="false">
                        <span class="text-base mr-auto">Total</span>
                        <span class="text-base mr-2">$ {{$carts_total_price}} </span>
                        <x-svg.solid-chevron-right class="w-5 h-5 text-gray-500" />
                    </button>
                </div>
            </div>

            <div>
                <div x-show="show"
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>

                <div x-show="show"
                     x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="translate-y-full"
                     x-transition:enter-end="translate-y-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-y-0"
                     x-transition:leave-end="translate-y-full"
                     class="relative bg-white px-4 py-6 sm:px-6">
                    <dl class="max-w-lg mx-auto space-y-6">
                        <div class="flex items-center justify-between">
                            <dt class="text-gray-600">Taxes</dt>
                            <dd>$26.80</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

    </x-slot>

    <x-slot name="slot">

        <form
            method="POST"
            action="{{route('charge.store')}}"
            class="pt-16 pb-36 px-4 sm:px-6 lg:pb-16 lg:px-0 lg:row-start-1 lg:col-start-1">
            @csrf
            <div class="max-w-lg mx-auto lg:max-w-none">

                <section aria-labelledby="shipping-heading" class="mt-10">

                    {{-- address --}}
                    <x-form.group class="mt-10">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Shipping Address" for="address_id"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-address wire:model="address_id" id="address_id" name="address_id"/>
                            <x-form.error-msg name="address_id"/>
                        </x-slot>
                    </x-form.group>

                    {{--  payment method --}}
                    <x-form.group class="mt-10">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Payment Method" for="payment_method"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.select wire:model="payment_method" id="payment_method" name="payment_method">
                                <option value="credit_card" selected="true">Credit Card</option>
                                <option value="paypal">Paypal</option>
{{--                                <option value="alipay">Alipay</option>--}}
                                <option value="fpx">FPX</option>
                            </x-form.select>
                            <x-form.error-msg name="payment_method"/>
                        </x-slot>
                    </x-form.group>

                </section>

                <div class="mt-10 pt-6 border-t border-gray-200 sm:flex sm:items-center sm:justify-between">

                    <p class="mt-4 text-center text-sm text-gray-500 sm:mt-0 sm:text-left">You won't be charged until the next step.</p>

                    <div>
                        <x-button.icon-on-the-left-btn
                            type="submit"
                            class="uppercase justify-center w-full"
                            wire:loading.class="cursor-not-allowed"
                            wire:loading.attr="disabled"
                            wire:target="checkout"
                        >
                            <x-svg.spin class="hidden text-white" wire:target="checkout" wire:loading.class.remove="hidden"/>
                            Continue
                        </x-button.icon-on-the-left-btn>
                    </div>

                </div>

            </div>
        </form>

    </x-slot>
</x-home.checkout-layout>
