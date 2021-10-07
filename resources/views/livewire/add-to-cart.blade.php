



<div>


    @if($level == 'primary')

        <button type="button"

                @click.prevent="$wire.addToCart({{$product_id}})"

                class="w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-50 focus:ring-blue-500">
            Add To Cart
        </button>

    @else
        <a @click.prevent="$wire.addToCart({{$product_id}})"
           href="#" class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200">
            Add to cart
        </a>

        @endif
</div>







