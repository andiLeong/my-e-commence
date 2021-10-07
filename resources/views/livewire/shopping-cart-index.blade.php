


<div class="bg-white">
    <div class="max-w-2xl mx-auto pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">

        @include('home._checkout-header')

        @if( $carts->isNotEmpty())

            <form class="mt-20 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                    <ul role="list" class="  border-t border-b border-gray-200 divide-y divide-gray-200">

                        @foreach($carts as $cart)
                            <li class="flex py-6 sm:py-10" wire:key="cart-{{ $loop->index }}">
                                <div class="flex-shrink-0">
                                    <img src="{{$cart->product->cover}}" alt="Basic Tee in sienna." class="w-24 h-24 rounded-md object-center object-cover sm:w-48 sm:h-48">
                                </div>

                                <div wire:loading.class=" animate-pulse" class=" ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <div class="flex justify-between">
                                                <h3 class="text-sm">
                                                    <a href="#" class="font-medium text-gray-700 hover:text-gray-800">
                                                        {{$cart->product->name}}
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="mt-1 flex text-sm">
                                                <p class="text-gray-500">
                                                    Quantity
                                                </p>

                                                <p class="ml-4 pl-4 border-l border-gray-200 text-gray-500">
                                                    {{$cart->quantity}}
                                                </p>
                                            </div>
                                            <p class="mt-1 text-sm font-medium text-gray-900">$ {{$cart->product->price}} </p>
                                        </div>

                                        <div class="mt-4 sm:mt-0 sm:pr-9">

                                            {{-- increase cart or decrease --}}
                                            <div class="flex items-center space-x-2">
                                                @livewire('shopping-cart-decrease' ,  ['cart' => $cart],  key("decrease-$cart->id"))
                                                <p> {{$cart->quantity}} </p>
                                                @livewire('shopping-cart-increase' ,  ['cart' => $cart],  key("increase-$cart->id"))
                                            </div>

                                            {{--   placeholder to cover the original button--}}
                                            <div class="absolute -right-5 -top-3 opacity-0 text-opacity-0 bg-transparent p-5 z-10 hidden"
                                                 wire:loading.class.remove="hidden">loading</div>
                                            <div class="absolute top-0 right-0 ">
                                                @livewire('shopping-cart-destroy' ,  ['cart_id' => $cart->id],  key("destroy-$cart->id"))
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-4 flex text-sm text-gray-700 space-x-2">
                                        <!-- Heroicon name: solid/check -->
                                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Total:  {{$cart->total}} </span>
                                    </p>
                                </div>
                            </li>


                        @endforeach
                    </ul>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="mt-16 bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <div class="flex items-center justify-between">
                        <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>
                        <button
                                wire:loading.class="cursor-not-allowed"
                                wire:loading.attr="disabled"
                                @click.prevent="$wire.destroyAll()"
                                type="button"
                                class="underline text-red-500 text-xs">Remove All</button>
                    </div>


                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">
                                Subtotal
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">
                                $ {{$carts_total_price}}
                            </dd>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>Shipping estimate</span>
                                <a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Learn more about how shipping is calculated</span>
                                    <!-- Heroicon name: solid/question-mark-circle -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">
                                $5.00
                            </dd>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="flex text-sm text-gray-600">
                                <span>Tax estimate</span>
                                <a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Learn more about how tax is calculated</span>
                                    <!-- Heroicon name: solid/question-mark-circle -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">
                                $8.32
                            </dd>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">
                                Order total
                            </dt>
                            <dd class="text-base font-medium text-gray-900">
                                $ {{$carts_total_price}}
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-6">

                        <x-button.icon-on-the-left-btn
                            class="uppercase justify-center w-full"
                            wire:loading.class="cursor-not-allowed"
                            wire:loading.attr="disabled"
                            wire:click.prevent="checkout()"
                        >
                            <x-svg.spin class="hidden text-white"  wire:loading.class.remove="hidden"/>
                            Checkout
                        </x-button.icon-on-the-left-btn>

                    </div>
                </section>
            </form>
        @else

            <x-empty-states.simple class="mt-20" title="Items yet" description="Go Shop Now"/>

        @endif

    </div>
</div>
