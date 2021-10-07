



<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mb-10">
        <h1 class="text-2xl font-semibold text-gray-900">Hi, @user_name , You're logged in!</h1>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">


        <div class="py-4">

            @if( $products->isNotEmpty() )

                <x-admin.table.table-view>
                    <x-admin.table.table  wire:loading.class="animate-pulse ">
                        <x-slot name="thead">
                            <x-admin.table.th>Name</x-admin.table.th>
                            <x-admin.table.th>Order</x-admin.table.th>
                            <x-admin.table.th>Via</x-admin.table.th>
                            <x-admin.table.th>Price</x-admin.table.th>
                            <x-admin.table.th>Quantity</x-admin.table.th>
                            <x-admin.table.th>Total</x-admin.table.th>
                            <x-admin.table.th>Created At</x-admin.table.th>
                        </x-slot>

                        @foreach( $products as $product)
                            <tr class="  @if( $loop->odd )  bg-white @else bg-gray-100 @endif"
                                wire:loading.class.delay="animate-pulse bg-gray-200"
                                wire:key="table{{ $product->id }}">

                                <x-admin.table.td is-first="true">{{$product->product_name}}</x-admin.table.td>
                                <x-admin.table.td>{{$product->order->order_number}}</x-admin.table.td>
                                <x-admin.table.td>{{$product->order->payment_method}}</x-admin.table.td>
                                <x-admin.table.td>{{$product->product_price}}</x-admin.table.td>
                                <x-admin.table.td>{{$product->quantity}}</x-admin.table.td>
                                <x-admin.table.td>{{$product->total_price}}</x-admin.table.td>
                                <x-admin.table.td>{{$product->created_at->diffForHumans()}}</x-admin.table.td>
                            </tr>
                        @endforeach

                    </x-admin.table.table>
                </x-admin.table.table-view>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>


            @endif


        </div>



    </div>
</div>




