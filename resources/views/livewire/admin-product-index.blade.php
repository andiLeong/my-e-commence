

<div class="py-4">

    @if( $products->isNotEmpty() )

        <div class="mb-10">
            <x-button.circular-btn
                wire:click.prevent="goToAdd"
                class="bg-gradient-to-b from-green-400 to-blue-600"
            >
                <x-svg.plus-outline class="h-6 w-6"  />
            </x-button.circular-btn>
        </div>

        <x-admin.table.table-view>
            <x-admin.table.table  wire:loading.class="animate-pulse ">
                <x-slot name="thead">
                    <x-admin.table.th>Name</x-admin.table.th>
                    <x-admin.table.th>Category</x-admin.table.th>
{{--                    <x-admin.table.th>Description</x-admin.table.th>--}}
                    <x-admin.table.th>Stocks</x-admin.table.th>
                    <x-admin.table.th>Price</x-admin.table.th>
                    <x-admin.table.th>On Sale</x-admin.table.th>
{{--                    <x-admin.table.th>Created At</x-admin.table.th>--}}
                    <x-admin.table.th>Updated At</x-admin.table.th>
                    <x-admin.table.th is-to-do="true">
                        <span class="sr-only">Go To Edit Link</span>
                    </x-admin.table.th>
                    <x-admin.table.th is-to-do="true">
                        <span class="sr-only">Go To Edit Cover Link</span>
                    </x-admin.table.th>
                    <x-admin.table.th is-to-do="true">
                        <span class="sr-only">Go To Edit Images Link</span>
                    </x-admin.table.th>
                </x-slot>

                @foreach( $products as $product)
                    <tr class="  @if( $loop->odd )  bg-white @else bg-gray-100 @endif"
                        wire:loading.class.delay="animate-pulse bg-gray-200"
                        wire:key="table{{ $product->id }}">

                        <x-admin.table.td is-first="true">{{$product->name}}</x-admin.table.td>
                        <x-admin.table.td>{{$product->category->name}}</x-admin.table.td>
{{--                        <x-admin.table.td>{{$product->shortDescription}}</x-admin.table.td>--}}
                        <x-admin.table.td>{{$product->stocks}}</x-admin.table.td>
                        <x-admin.table.td>{{$product->price}}</x-admin.table.td>
                        <x-admin.table.td>
                            <span>
                            @if($product->on_sale)
                                <x-admin.table.status class="cursor-pointer" wire:click="updateOnSale({{$product->id}},{{$product->on_sale}})">Yes</x-admin.table.status>
                            @else
                                <x-admin.table.status class="cursor-pointer" wire:click="updateOnSale({{$product->id}})" type="danger">No</x-admin.table.status>
                            @endif
                            </span>
                        </x-admin.table.td>
{{--                        <x-admin.table.td>{{$product->created_at->format('Y-m-d H:m')}}</x-admin.table.td>--}}
                        <x-admin.table.td>{{$product->updated_at->diffForHumans()}}</x-admin.table.td>

                        <x-admin.table.td is-to-do="true" >
                            <a href="{{route('admin.product.edit',$product->id)}}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        </x-admin.table.td>

                        <x-admin.table.td is-to-do="true" >
                            <a href="{{route('admin.product.cover.edit',$product->id)}}" class="text-blue-600 hover:text-blue-900">Cover</a>
                        </x-admin.table.td>

                        <x-admin.table.td is-to-do="true" >
                            <a href="{{route('admin.product.image.edit',$product->id)}}" class="text-blue-600 hover:text-blue-900">Images</a>
                        </x-admin.table.td>

                    </tr>
                @endforeach

            </x-admin.table.table>
        </x-admin.table.table-view>

        <div class="mt-10">
            {{ $products->links() }}
        </div>

    @else
        <div class="mt-10" x-data="">
            <x-empty-states.simple title="Product" description="get start by creating a product">
                <x-button.icon-on-the-left-btn wire:click.prevent="goToAdd">
                    <x-svg.plus-solid class="-ml-1 mr-2 h-5 w-5" />
                    New Product
                </x-button.icon-on-the-left-btn>
            </x-empty-states.simple>
        </div>
    @endif


</div>
