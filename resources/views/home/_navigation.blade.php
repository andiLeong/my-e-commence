

<!--
  Mobile menu
-->
<div x-show="open" x-cloak class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">

    <div @click="open = false"
         x-show="open"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>

    <div
        x-show="open"
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="relative max-w-xs w-full bg-white shadow-xl pb-12 flex flex-col overflow-y-auto"
    >
        <div class="px-4 pt-5 pb-2 flex">
            <button @click="open = false" type="button" class="-m-2 p-2 rounded-md inline-flex items-center justify-center text-gray-400">
                <span class="sr-only">Close menu</span>
                <x-svg.x class="h-6 w-6" />
            </button>
        </div>

        <!-- Links -->
        <div class="border-t border-gray-200 py-6 px-4 space-y-6">
            <div class="flow-root">
                <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Company</a>
            </div>

            <div class="flow-root">
                <a href="{{route('product.index')}}" class="-m-2 p-2 block font-medium text-gray-900">Products</a>
            </div>
        </div>

        <div class="border-t border-gray-200 py-6 px-4 space-y-6">
            <div class="flow-root">
                <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Create an account</a>
            </div>
            <div class="flow-root">
                <a href="#" class="-m-2 p-2 block font-medium text-gray-900">Sign in</a>
            </div>
        </div>

        <div class="border-t border-gray-200 py-6 px-4 space-y-6">
            <!-- Currency selector -->
            <form>
                <div class="inline-block">
                    <label for="mobile-currency" class="sr-only">Currency</label>
                    <div class="-ml-2 group relative border-transparent rounded-md focus-within:ring-2 focus-within:ring-white">
                        <select id="mobile-currency" name="currency" class="bg-none border-transparent rounded-md py-0.5 pl-2 pr-5 flex items-center text-sm font-medium text-gray-700 group-hover:text-gray-800 focus:outline-none focus:ring-0 focus:border-transparent">
                            <option>CAD</option>

                            <option>USD</option>

                            <option>AUD</option>

                            <option>EUR</option>

                            <option>GBP</option>
                        </select>
                        <div class="absolute right-0 inset-y-0 flex items-center pointer-events-none">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" class="w-5 h-5 text-gray-500">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<header class="relative z-10">
    <nav aria-label="Top">
        <!-- Top navigation -->
        @include('home._top-navigation')

        <!-- Secondary navigation -->
        <div class="bg-white">
            <div class="border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="h-16 flex items-center justify-between">
                        <!-- Logo (lg+) -->
                        <div class="hidden lg:flex lg:items-center">
                            <a href="/">
                                <span class="sr-only">Workflow</span>
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=blue&shade=600" alt="">
                            </a>
                        </div>

                        <div class="hidden h-full lg:flex">
                            <!-- Mega menus -->
                            <div class="ml-8">
                                <div class="h-full flex justify-center space-x-8">
                                    <div class="flex" x-data="{megaMenu:false}">
                                        <div class="relative flex">

                                            <button @click="megaMenu = !megaMenu"
                                                    :class="megaMenu ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-700 hover:text-gray-800'"
                                                    type="button"
                                                    class=" relative z-10 flex items-center transition-colors ease-out duration-200 text-sm font-medium border-b-2 -mb-px pt-px"
                                                    aria-expanded="false">
                                                Women
                                            </button>
                                        </div>

                                        <div x-show="megaMenu"
                                             x-cloak
                                             @click.away="megaMenu = false"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0"
                                             x-transition:enter-end="opacity-100"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100"
                                             x-transition:leave-end="opacity-0"
                                             class="absolute top-full inset-x-0 text-gray-500 sm:text-sm">
                                            <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                            <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>

                                            <div class="relative bg-white">
                                                <div class="max-w-7xl mx-auto px-8">
                                                    <div class="grid grid-cols-2 items-start gap-y-10 gap-x-8 pt-10 pb-12">
                                                        <div class="grid grid-cols-2 gap-y-10 gap-x-8">
                                                            <div>
                                                                <p id="desktop-featured-heading-0" class="font-medium text-gray-900">
                                                                    Featured
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-featured-heading-0" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Sleep
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Swimwear
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Underwear
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div>
                                                                <p id="desktop-categories-heading" class="font-medium text-gray-900">
                                                                    Categories
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-categories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Basic Tees
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Artwork Tees
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Bottoms
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Underwear
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Accessories
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-y-10 gap-x-8">
                                                            <div>
                                                                <p id="desktop-collection-heading" class="font-medium text-gray-900">
                                                                    Collection
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-collection-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Everything
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Core
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            New Arrivals
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Sale
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div>
                                                                <p id="desktop-brand-heading" class="font-medium text-gray-900">
                                                                    Brands
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-brand-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Full Nelson
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            My Way
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Re-Arranged
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Counterfeit
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Significant Other
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex" x-data="{megaMenu:false}">
                                        <div class="relative flex">
                                            <!-- Item active: "border-indigo-600 text-indigo-600", Item inactive: "border-transparent text-gray-700 hover:text-gray-800" -->
                                            <button @click="megaMenu = !megaMenu"
                                                    :class="megaMenu ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-700 hover:text-gray-800'"
                                                    type="button" class="relative z-10 flex items-center transition-colors ease-out duration-200 text-sm font-medium border-b-2 -mb-px pt-px" aria-expanded="false">
                                                Men
                                            </button>
                                        </div>

                                        <div x-show="megaMenu"
                                             x-cloak
                                             @click.away="megaMenu = false"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0"
                                             x-transition:enter-end="opacity-100"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100"
                                             x-transition:leave-end="opacity-0"
                                             class="absolute top-full inset-x-0 text-gray-500 sm:text-sm">
                                            <!-- Presentational element used to render the bottom shadow, if we put the shadow on the actual panel it pokes out the top, so we use this shorter element to hide the top of the shadow -->
                                            <div class="absolute inset-0 top-1/2 bg-white shadow" aria-hidden="true"></div>

                                            <div class="relative bg-white">
                                                <div class="max-w-7xl mx-auto px-8">
                                                    <div class="grid grid-cols-2 items-start gap-y-10 gap-x-8 pt-10 pb-12">
                                                        <div class="grid grid-cols-2 gap-y-10 gap-x-8">
                                                            <div>
                                                                <p id="desktop-featured-heading-1" class="font-medium text-gray-900">
                                                                    Featured
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-featured-heading-1" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Casual
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Boxers
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Outdoor
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div>
                                                                <p id="desktop-categories-heading" class="font-medium text-gray-900">
                                                                    Categories
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-categories-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Artwork Tees
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Pants
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Accessories
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Boxers
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Basic Tees
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-y-10 gap-x-8">
                                                            <div>
                                                                <p id="desktop-collection-heading" class="font-medium text-gray-900">
                                                                    Collection
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-collection-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Everything
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Core
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            New Arrivals
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Sale
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div>
                                                                <p id="desktop-brand-heading" class="font-medium text-gray-900">
                                                                    Brands
                                                                </p>
                                                                <ul role="list" aria-labelledby="desktop-brand-heading" class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Significant Other
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            My Way
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Counterfeit
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Re-Arranged
                                                                        </a>
                                                                    </li>

                                                                    <li class="flex">
                                                                        <a href="#" class="hover:text-gray-800">
                                                                            Full Nelson
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{route('product.index')}}" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">Products</a>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile menu and search (lg-) -->
                        <div class="flex-1 flex items-center lg:hidden">
                            <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
                            <button @click="open = !open" type="button" class="-ml-2 bg-white p-2 rounded-md text-gray-400">
                                <span class="sr-only">Open menu</span>
                                <x-svg.menu class="h-6 w-6" />
                            </button>

                            <!-- Search -->
                            <a href="#" class="ml-2 p-2 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">Search</span>
                                <!-- Heroicon name: outline/search -->
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </a>
                        </div>

                        <!-- Logo (lg-) -->
                        <a href="/" class="lg:hidden">
                            <span class="sr-only">Workflow</span>
                            <img src="https://tailwindui.com/img/logos/workflow-mark.svg?color=blue&shade=600" alt="" class="h-8 w-auto">
                        </a>

                        <div class="flex-1 flex items-center justify-end">
                            <div class="flex items-center lg:ml-8">
                                <div class="flex space-x-8">
                                    <div class="hidden lg:flex">
                                        <a href="#" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Search</span>
                                            <!-- Heroicon name: outline/search -->
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </a>
                                    </div>

                                    <div class="flex">
                                        <a href="{{route('user.profile.show')}}" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Account</span>
                                            <x-svg.user class="w-6 h-6" />
                                        </a>
                                    </div>
                                </div>

                                <span class="mx-4 h-6 w-px bg-gray-200 lg:mx-6" aria-hidden="true"></span>

                                <div class="flow-root">
                                    @livewire('shopping-cart-counter')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
