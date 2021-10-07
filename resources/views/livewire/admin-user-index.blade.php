<div class="py-4">

    @if( $users->isNotEmpty() )

        <x-admin.table.table-view>
            <x-admin.table.table  wire:loading.class="animate-pulse ">
                <x-slot name="thead">
                    <x-admin.table.th>Name</x-admin.table.th>
                    <x-admin.table.th>Email</x-admin.table.th>
                    <x-admin.table.th>Created At</x-admin.table.th>
                    <x-admin.table.th is-to-do="true">
                        <span class="sr-only">To Do Button</span>
                    </x-admin.table.th>
                </x-slot>

                @foreach( $users as $user)
                    <tr class="  @if( $loop->odd )  bg-white @else bg-gray-100 @endif"
                        wire:loading.class.delay="animate-pulse bg-gray-200"
                        wire:key="table{{ $user->id }}">

                        <x-admin.table.td is-first="true">
                            {{$user->name}}
                        </x-admin.table.td>

                        <x-admin.table.td>
                            {{$user->email}}
                        </x-admin.table.td>

                        <x-admin.table.td>
                            {{$user->created_at->format('Y-m-d H:m')}}
                        </x-admin.table.td>

                        <x-admin.table.td is-to-do="true" >
                            <a href="{{route('admin.user.edit',$user->id)}}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        </x-admin.table.td>
                    </tr>
                @endforeach
            </x-admin.table.table>
        </x-admin.table.table-view>

        <div class="mt-10">
            {{ $users->links() }}
        </div>

    @endif

</div>


