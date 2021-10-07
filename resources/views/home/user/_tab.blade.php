

<div class="sm:hidden px-4" x-data="{}">
    <label for="tabs" class="sr-only">Select a tab</label>
    <select
        @change="window.location.replace($event.target.value);"
        id="tabs" name="tabs" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
    >
        <option @if(request()->routeIs('user.profile.show')) selected @endif value="{{route('user.profile.show')}}">Profile</option>
        <option @if(request()->routeIs('address.index')) selected @endif value="{{route('address.index')}}">Address</option>
        <option @if(request()->routeIs('order.index')) selected @endif value="{{route('order.index')}}" >Orders</option>
    </select>
</div>


<div class="hidden sm:block">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <x-link.tab-link href="{{route('user.profile.show')}}" :active="request()->routeIs('user.profile.show')">Profile</x-link.tab-link>
            <x-link.tab-link href="{{route('address.index')}}" :active="request()->routeIs('address.index')">Address </x-link.tab-link>
            <x-link.tab-link href="{{route('order.index')}}" :active="request()->routeIs('order.index')">Orders</x-link.tab-link>
        </nav>
    </div>
</div>
