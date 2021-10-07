

<div class="py-4 mb-20 mt-5 md:px-0 px-4">


    <div class="mb-10">
        <x-button.circular-btn
            wire:click.prevent="goToAdd"
            class="bg-gradient-to-b from-blue-200 to-blue-600"
        >
            <x-svg.plus-outline class="h-6 w-6"  />
        </x-button.circular-btn>
    </div>


    @if( $addresses->isNotEmpty() )

        <x-admin.table.table-view>
            <x-admin.table.table  wire:loading.class="animate-pulse ">
                <x-slot name="thead">
                    <x-admin.table.th>Name</x-admin.table.th>
                    <x-admin.table.th>Province</x-admin.table.th>
                    <x-admin.table.th>City</x-admin.table.th>
                    <x-admin.table.th>District</x-admin.table.th>
                    <x-admin.table.th>Street</x-admin.table.th>
                    <x-admin.table.th>Mobile Number</x-admin.table.th>
                    <x-admin.table.th is-to-do="true">
                        <span class="sr-only">Go To Edit Link</span>
                    </x-admin.table.th>
                    <x-admin.table.th is-to-do="true">
                        <span class="sr-only">Go To Delete Action</span>
                    </x-admin.table.th>
                </x-slot>

                @foreach( $addresses as $address)
                    <tr class="  @if( $loop->odd )  bg-white @else bg-gray-100 @endif"
                        wire:loading.class.delay="animate-pulse bg-gray-200"
                        wire:key="table-{{ $address->id }}">

                        <x-admin.table.td is-first="true">{{$address->consignee}}</x-admin.table.td>
                        <x-admin.table.td>{{$address->province}}</x-admin.table.td>
                        <x-admin.table.td>{{$address->city}}</x-admin.table.td>
                        <x-admin.table.td>{{$address->district}}</x-admin.table.td>
                        <x-admin.table.td>{{$address->street}}</x-admin.table.td>
                        <x-admin.table.td>{{$address->mobile_number}}</x-admin.table.td>

                        <x-admin.table.td is-to-do="true" >
                            <a href="{{route('address.edit',$address->id)}}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        </x-admin.table.td>

                        <x-admin.table.td is-to-do="true" >
                            @livewire('address-destroy' , [ 'address' => $address] ,  key('destroy'.$address->id) )
                        </x-admin.table.td>

                    </tr>
                @endforeach

            </x-admin.table.table>
        </x-admin.table.table-view>

    @endif



</div>

