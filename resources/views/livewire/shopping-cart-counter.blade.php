<div>

    <a href="{{route('shoppingCart.index')}}" class="group -m-2 p-2 flex items-center " >
        @if($counter > 0)
            <x-svg.shopping-cart class=" flex-shrink-0 h-6 w-6 text-red-400 group-hover:text-red-500"  />
        @else
            <x-svg.shopping-cart class="flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500"  />
        @endif
        <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800"> {{ $counter }}
        </span>
        <span class="sr-only">items in cart, view bag</span>
    </a>

</div>
