

<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div x-show="side_bar_menu_show" class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">

    <div
        x-show="side_bar_menu_show"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>

    <div
        x-show="side_bar_menu_show"
        @click.outside="side_bar_menu_show = false"
        x-transition:enter="transition ease-in-out duration-3000 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="relative flex-1 flex flex-col max-w-xs w-full bg-white">

        <div
            x-show="side_bar_menu_show"
            x-transition:enter="ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in-out duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute top-0 right-0 -mr-12 pt-2">
            <button @click="side_bar_menu_show = false"  type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <span class="sr-only">Close sidebar</span>
                <x-svg.x class="h-6 w-6 text-white" />
            </button>
        </div>

        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
            <div class="flex-shrink-0 flex items-center px-4">
                <a href="/">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
                </a>
            </div>
            <nav class="mt-5 px-2 space-y-1">
                <!-- Current: "bg-gray-100 text-gray-900", Default: "text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
                <x-admin.sidebar-links href="{{route('admin.dashboard')}}">
                    <x-svg.home class="text-gray-500 mr-4 flex-shrink-0 h-6 w-6"/>
                    Dashboard
                </x-admin.sidebar-links>

                <x-admin.sidebar-links href="{{route('admin.user.index')}}">
                    <x-svg.users class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6"/>
                    User
                </x-admin.sidebar-links>

                <x-admin.sidebar-links href="{{route('admin.product.index')}}">
                    <x-svg.folder class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6" />
                    Products
                </x-admin.sidebar-links>

                <x-admin.sidebar-links href="{{route('admin.order.product.index')}}">
                    <x-svg.calendar class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6" />
                    Order Products
                </x-admin.sidebar-links>

                <x-admin.sidebar-links href="{{route('admin.category.index')}}">
                    <x-svg.inbox class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6"/>
                    Category
                </x-admin.sidebar-links>

                <x-admin.sidebar-links href="{{route('admin.order.index')}}">
                    <x-svg.chart-bar class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6" />
                    Orders
                </x-admin.sidebar-links>

                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <x-admin.sidebar-links tag="button" type="submit" class="w-full">
                        <x-svg.logout class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" />
                        Log out
                    </x-admin.sidebar-links>
                </form>

            </nav>
        </div>
        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
            <x-admin.profile-links href="{{route('admin.user.edit',auth()->id())}}" profile-img-size="h-10 w-10" />
        </div>
    </div>

    <div class="flex-shrink-0 w-14">
        <!-- Force sidebar to shrink to fit close icon -->
    </div>
</div>

<!-- Static sidebar for desktop -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white">
            <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4">
                    <a href="/">
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
                    </a>
                </div>
                <nav class="mt-5 flex-1 px-2 bg-white space-y-1">
                    <!-- Current: "bg-gray-100 text-gray-900", Default: "text-gray-600 hover:bg-gray-50 hover:text-gray-900" -->
                    <x-admin.sidebar-links href="{{route('admin.dashboard')}}">
                        <x-svg.home class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6"/>
                        Dashboard
                    </x-admin.sidebar-links>

                    <x-admin.sidebar-links href="{{route('admin.user.index')}}">
                        <x-svg.users class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"/>
                        User
                    </x-admin.sidebar-links>

                    <x-admin.sidebar-links href="{{route('admin.product.index')}}">
                        <x-svg.folder class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" />
                        Products
                    </x-admin.sidebar-links>

                    <x-admin.sidebar-links href="{{route('admin.order.product.index')}}">
                        <x-svg.calendar class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" />
                        Order Products
                    </x-admin.sidebar-links>

                    <x-admin.sidebar-links href="{{route('admin.category.index')}}">
                        <x-svg.inbox class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"/>
                        Category
                    </x-admin.sidebar-links>

                    <x-admin.sidebar-links href="{{route('admin.order.index')}}">
                        <x-svg.chart-bar class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" />
                        Orders
                    </x-admin.sidebar-links>

                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                    <x-admin.sidebar-links tag="button" type="submit" class="w-full">
                        <x-svg.logout class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6" />
                        Log out
                    </x-admin.sidebar-links>
                    </form>


                </nav>
            </div>
            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <x-admin.profile-links href="{{route('admin.user.edit',auth()->id())}}" profile-img-size="h-9 w-9"/>
            </div>
        </div>
    </div>
</div>




