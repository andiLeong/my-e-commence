<div>



    <div class="bg-white">
        <div x-data="{showFilter:false}">
            <!--
              Mobile filter dialog

              Off-canvas menu for mobile, show/hide based on off-canvas menu state.
            -->
            <div x-show="showFilter" class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">

                <div x-show="showFilter"
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>

                <div
                    @click.outside="showFilter = false"
                    x-show="showFilter"
                    x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="ml-auto relative max-w-xs w-full h-full bg-white shadow-xl py-4 pb-6 flex flex-col overflow-y-auto">
                    <div class="px-4 flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                        <button @click="showFilter = false" type="button" class="-mr-2 w-10 h-10 p-2 flex items-center justify-center text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close menu</span>
                            <x-svg.x class="h-6 w-6" />
                        </button>
                    </div>

                    <!-- Filters -->
                    <form class="mt-4">
                        <div x-data="{showFilterInput : true}" class="border-t border-gray-200 pt-4 pb-4">
                            <fieldset>
                                <legend class="w-full px-2">
                                    <!-- Expand/collapse section button -->
                                    <button @click.prevent="showFilterInput = !showFilterInput"
                                            type="button"
                                            class="w-full p-2 flex items-center justify-between text-gray-400 hover:text-gray-500" aria-controls="filter-section-1" aria-expanded="false">
                                        <span class="text-sm font-medium text-gray-900">Category</span>
                                        <span class="ml-6 h-7 flex items-center">
                                            <svg :class="showFilterInput ? '-rotate-180' : 'rotate-0' "
                                                 class="rotate-0 h-5 w-5 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                 <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>
                                </legend>
                                <div x-show="showFilterInput" class="pt-4 pb-2 px-4" id="filter-section-1">
                                    <div class="space-y-6">
                                        <x-category wire:model.defer="category_id" name="category_id" id="category_id" />
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div x-data="{showFilterInput : true}" class="border-t border-gray-200 pt-4 pb-4">
                            <fieldset>
                                <legend class="w-full px-2">
                                    <!-- Expand/collapse section button -->
                                    <button @click.prevent="showFilterInput = !showFilterInput"
                                            type="button"
                                            class="w-full p-2 flex items-center justify-between text-gray-400 hover:text-gray-500" aria-controls="filter-section-1" aria-expanded="false">
                                        <span class="text-sm font-medium text-gray-900">Search Product Name</span>
                                        <span class="ml-6 h-7 flex items-center">
                                            <svg :class="showFilterInput ? '-rotate-180' : 'rotate-0' "
                                                 class="rotate-0 h-5 w-5 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                 <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>
                                </legend>
                                <div x-show="showFilterInput" class="pt-4 pb-2 px-4" id="filter-section-1">
                                    <div class="space-y-6">
                                        <x-form.input wire:model.defer="name" name="name" placeholder="Search Product Name"/>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="flex justify-center ">
                            <button
                                @click.prevent="$wire.resetPro()"
                                wire:loading.class="cursor-not-allowed"
                                wire:loading.attr="disabled"
                                class="text-gray-600 underline">Reset</button>
                        </div>

                        <div class="px-10 mt-2">
                            <x-button.icon-on-the-left-btn
                                class="uppercase justify-center w-full"
                                wire:loading.class="cursor-not-allowed"
                                wire:loading.attr="disabled"
                                @click.prevent="$wire.search()"
                            >
                                <x-svg.spin class="hidden text-white" wire:target="search" wire:loading.class.remove="hidden"/>
                                Search
                            </x-button.icon-on-the-left-btn>
                        </div>

                    </form>
                </div>
            </div>

            <main class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="border-b border-gray-200 pb-10">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">New Arrivals</h1>
                    <p class="mt-4 text-base text-gray-500">Checkout out the latest release of Basic Tees, new and improved with four openings!</p>
                </div>

                <div class="pt-6 lg:grid lg:grid-cols-3 lg:gap-x-8 xl:grid-cols-4">
                    <aside>
                        <h2 class="sr-only">Filters</h2>
                        <!-- Mobile filter dialog toggle, controls the 'mobileFilterDialogOpen' state. -->
                        <button @click="showFilter = !showFilter" type="button" class="inline-flex items-center lg:hidden">
                            <span class="text-sm font-medium text-gray-700">Filters222</span>
                            <x-svg.plus-outline class="flex-shrink-0 ml-1 h-5 w-5 text-gray-400" />
                        </button>

                        <div class="hidden lg:block border-r border-r-2 md:pr-3 border-gray-400 space-y-6">

                                <div class="pt-5">
                                    <x-form.label value="Product Name" for="name"/>
                                    <div class="pt-1">
                                        <x-form.input wire:model.defer="name" name="name" placeholder="Search Product Name"/>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <x-form.label value="Category" for="category_id"/>
                                    <div class="pt-1">
                                        <x-category wire:model.defer="category_id" name="category_id" id="category_id" />
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-center ">
                                        <button
                                                @click.prevent="$wire.resetPro()"
                                                wire:loading.class="cursor-not-allowed"
                                                wire:loading.attr="disabled"
                                                class="text-gray-600 underline">Reset</button>
                                    </div>

                                    <div class="pt-1">
                                        <x-button.icon-on-the-left-btn
                                            class="uppercase justify-center w-full"
                                            wire:loading.class="cursor-not-allowed"
                                            wire:loading.attr="disabled"
                                            @click.prevent="$wire.search()"
                                        >
                                            <x-svg.spin class="hidden text-white" wire:target="search" wire:loading.class.remove="hidden"/>
                                            Search
                                        </x-button.icon-on-the-left-btn>
                                    </div>
                                </div>
                        </div>
                    </aside>

                    <!-- Product grid -->
                    <div class="mt-2 lg:mt-0 lg:col-span-2 xl:col-span-3">

                        <section aria-labelledby="related-heading" class="mt-8 sm:mt-10">

                            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                                @foreach($products as $product)
                                <div class="group relative flex flex-col">
                                    <div class="w-full min-h-80 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
                                        <img src="{{$product->cover}}" alt="{{$product->name}}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
                                    </div>
                                    <div class="mt-4 flex justify-between flex-1">
                                        <div>
                                            <h3 class="font-bold text-blue-500 uppercase">
                                                <a href="{{route('product.show', $product->slug)}}">{{$product->name}}</a>
                                            </h3>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">${{$product->price}} </p>
                                    </div>
                                    {{-- add to cart --}}
                                    <div class="mt-6">
                                        @if( is_null($product->added_to_cart) )
                                            @livewire('add-to-cart', ['product_id' => $product->id , 'level' => 'secondary' ] ,  key('add-to-cart'.$product->id))
                                        @else
                                            <x-button.added-to-cart-span>Added to cart</x-button.added-to-cart-span>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-10">
                                {{ $products->links() }}
                            </div>

                        </section>

                    </div>
                </div>
            </main>
        </div>
    </div>




</div>
