

<div class="bg-blue-500">
    <div class="max-w-7xl mx-auto h-10 px-4 flex items-center justify-between sm:px-6 lg:px-8">

        <p class="flex-1 text-center text-sm font-medium text-white lg:flex-none">
            Get free delivery on orders over $100
        </p>

        <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
            @guest
                <a href="/register" class="text-sm font-medium text-white hover:text-gray-100">Create an account</a>
                <span class="h-6 w-px bg-white" aria-hidden="true"></span>
                <a href="/login" class="text-sm font-medium text-white hover:text-gray-100">Log in</a>
            @endguest
            @auth
                <span class="text-sm font-medium text-white hover:text-gray-100">Welcome 2 @user_name</span>
                @admin
                <a href="{{route('admin.dashboard')}}" class="text-sm font-medium text-white hover:text-gray-100">Dashboard</a>
                @endadmin
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a onclick="event.preventDefault();
                                            this.closest('form').submit();"
                       href="{{route('logout')}}"
                       class="text-sm font-medium text-white hover:text-gray-100"
                    >Log out</a>
                </form>
            @endauth
        </div>
    </div>
</div>
