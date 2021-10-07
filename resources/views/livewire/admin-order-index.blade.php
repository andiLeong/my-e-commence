

<div class="py-4">

    @if( $orders->isNotEmpty() )


        <x-admin.table.table-view>
            <x-admin.table.table  wire:loading.class="animate-pulse ">
                <x-slot name="thead">
                    <x-admin.table.th>ID</x-admin.table.th>
                    <x-admin.table.th>Order Number</x-admin.table.th>
                    <x-admin.table.th>User</x-admin.table.th>
                    <x-admin.table.th>Vendor</x-admin.table.th>
                    <x-admin.table.th>Status</x-admin.table.th>
{{--                    <x-admin.table.th>Delivery</x-admin.table.th>--}}
                    <x-admin.table.th>Amount</x-admin.table.th>
                    <x-admin.table.th>Created At</x-admin.table.th>
                    <x-admin.table.th is-to-do="true">
                        <span class="sr-only">Go To Edit Link</span>
                    </x-admin.table.th>

                </x-slot>

                @foreach( $orders as $order)
                    <tr class="  @if( $loop->odd )  bg-white @else bg-gray-100 @endif"
                        wire:loading.class.delay="animate-pulse bg-gray-200"
                        wire:key="table{{ $order->order_number }}">

                        <x-admin.table.td is-first="true">{{$order->id}}</x-admin.table.td>
                        <x-admin.table.td is-first="true">{{$order->order_number}}</x-admin.table.td>
                        <x-admin.table.td>{{$order->user->name}}</x-admin.table.td>
                        <x-admin.table.td>
                            {{$order->payment_vendor}}-{{$order->payment_method}}
                        </x-admin.table.td>
                        <x-admin.table.td>
                            <span>
                            @if($order->status == 'paid')
                                <x-admin.table.status type="success">{{ ucfirst($order->status) }}</x-admin.table.status>
                            @else
                                <x-admin.table.status type="danger">{{$order->status}}</x-admin.table.status>
                            @endif
                            </span>
                        </x-admin.table.td>
{{--                        <x-admin.table.td>--}}
{{--                            <span>--}}
{{--                            @if($order->delivery_status)--}}
{{--                                    <x-admin.table.status class="cursor-pointer">Delivered</x-admin.table.status>--}}
{{--                                @else--}}
{{--                                    <x-admin.table.status class="cursor-pointer">No Deliver</x-admin.table.status>--}}
{{--                                @endif--}}
{{--                            </span>--}}
{{--                        </x-admin.table.td>--}}
                        <x-admin.table.td>$ {{$order->total_price}}</x-admin.table.td>
                        <x-admin.table.td>{{$order->created_at->diffForHumans()}}</x-admin.table.td>


                        <x-admin.table.td is-to-do="true" >
                            @if($order->status == 'paid')
                                @livewire('refund', ['orderId' => $order->id],  key("refund-".$order->id) )
                            @else
                                <span class="sr-only" >no refund action</span>
                            @endif
                        </x-admin.table.td>




                    </tr>
                @endforeach

            </x-admin.table.table>
        </x-admin.table.table-view>

        <div class="mt-10">
            {{ $orders->links() }}
        </div>

    @else
        <div class="mt-10">
            <p>no orders</p>
        </div>
    @endif


</div>
