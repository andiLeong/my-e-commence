

<div
    x-data="{isOpen: false}"
    @close-dropdown.window="isOpen = false"
    class="relative inline-block text-left"
>

    <div @click="isOpen = !isOpen " >
{{--        trigger--}}
        {{$trigger}}
    </div>

    <div
        x-cloak
        x-show="isOpen == true"
        @click.away="isOpen = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="z-10 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="menu-button"
        tabindex="-1"
    >

        {{$content}}
    </div>
</div>
