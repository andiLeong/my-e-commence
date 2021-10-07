

<header class="relative bg-white border-b border-gray-200 text-sm font-medium text-gray-700">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="relative flex justify-end sm:justify-center">

            <nav aria-label="Progress" class="hidden sm:block">
                <ol role="list" class="flex space-x-4">
                    <li class="flex items-center">
                        <a href="{{route('shoppingCart.index')}}"
                           @if( request()->routeIs('shoppingCart.index') ) aria-current="page" class="text-blue-600" @endif
                        >Cart</a>
                        <x-svg.solid-chevron-right class="w-5 h-5 text-gray-300 ml-4" />
                    </li>

                    <li class="flex items-center">
                        <a href="{{route('checkout.index')}}"
                           @if( request()->routeIs('checkout.index') ) aria-current="page" class="text-blue-600" @endif
                        >Billing Information</a>
                        <x-svg.solid-chevron-right class="w-5 h-5 text-gray-300 ml-4" />
                    </li>

                    <li class="flex items-center">
                        <a href="#"
                           @if( request()->routeIs('charge.store') ) aria-current="page" class="text-blue-600" @endif
                        >Process Charging</a>
                    </li>
                </ol>
            </nav>
            <p class="sm:hidden">Step 2 of 4</p>
        </div>
    </div>
</header>
