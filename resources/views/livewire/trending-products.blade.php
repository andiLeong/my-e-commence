

<div class="relative w-full overflow-x-auto">

    @if($products)
        <ul  role="list" class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:space-x-0 lg:grid lg:grid-cols-4 lg:gap-x-8">
            @foreach($products as $product)
                <li  class="w-64 inline-flex flex-col text-center lg:w-auto" wire:key="product-{{ $product->id }}" >
                    <div class="group relative">
                        <div class="w-full bg-gray-200 rounded-md overflow-hidden aspect-w-1 aspect-h-1">
                            <img src="{{$product->cover}}" alt="{{$product->name}}" class="w-full h-full object-center object-cover group-hover:opacity-75">
                        </div>
                        <div class="mt-6">
                            <p class="text-sm text-gray-500">
                                Black
                            </p>
                            <h3 class="mt-1 font-semibold text-gray-900">
                                <a href="{{route('product.show',$product->slug)}}">
                                    <span class="absolute inset-0"></span>
                                    {{$product->name}}
                                </a>
                            </h3>
                            <p class="mt-1 text-gray-900">
                                $ {{$product->price}}
                            </p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <ul wire:init="load" role="list" class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:space-x-0 lg:grid lg:grid-cols-4 lg:gap-x-8">
            @foreach( range(0,3) as $number)
                <li  class="border border-gray-300 shadow rounded-md p-2 max-w-sm w-full mx-auto" wire:key="loading-{{$loop->index}}">
                    <div class="animate-pulse  flex flex-col items-center">
                        <div class="rounded bg-gray-400 h-36 w-32 mb-6"></div>
                        <div class="mb-1 h-4 bg-gray-400 text-transparent rounded ">{{ str_repeat('-', rand(10,15)) }}</div>
                        <div class="mb-1 h-4 bg-gray-400 text-transparent rounded ">{{ str_repeat('-', rand(10,30)) }}</div>
                        <div class="mb-1 h-4 bg-gray-400 text-transparent rounded ">{{ str_repeat('-', rand(5,15)) }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

</div>





