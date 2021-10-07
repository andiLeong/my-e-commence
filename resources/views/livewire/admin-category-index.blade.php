<div class="py-4">

    @if( $categories->isNotEmpty() )

    <div class="mb-10">
        <x-button.circular-btn
            @click.prevent="$dispatch('open-modal')"
            class="bg-gradient-to-b from-green-400 to-blue-600"
        >
            <x-svg.plus-outline class="h-6 w-6"  />
        </x-button.circular-btn>
    </div>

    <x-admin.table.table-view>
        <x-admin.table.table  wire:loading.class="animate-pulse ">
            <x-slot name="thead">
                <x-admin.table.th>Name</x-admin.table.th>
                <x-admin.table.th># of Products</x-admin.table.th>
                <x-admin.table.th>Created At</x-admin.table.th>
                <x-admin.table.th>Updated At</x-admin.table.th>
                <x-admin.table.th is-to-do="true">
                    <span class="sr-only">To Do Button</span>
                </x-admin.table.th>
            </x-slot>

            @foreach( $categories as $category)
                <tr class="  @if( $loop->odd )  bg-white @else bg-gray-100 @endif"
                    wire:loading.class.delay="animate-pulse bg-gray-200"
                    wire:key="table{{ $category->id }}09090here">

                    <x-admin.table.td is-first="true">
                        {{$category->name}}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{$category->product_counts}}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{$category->created_at->format('Y-m-d H:m')}}
                    </x-admin.table.td>

                    <x-admin.table.td>
                        {{$category->updated_at->diffForHumans()}}
                    </x-admin.table.td>

                    <x-admin.table.td is-to-do="true" >
                        @livewire('category-update' , [ 'category' => $category] ,  key('update'.$category->id) )
                    </x-admin.table.td>

                </tr>
            @endforeach

        </x-admin.table.table>
    </x-admin.table.table-view>

    <div class="mt-10">
        {{ $categories->links() }}
    </div>

    @else
        <div class="mt-10" x-data="">
            <x-empty-states.simple title="category" description="get start by creating a category">
                <x-button.icon-on-the-left-btn @click.prevent="$dispatch('open-modal')">
                    <x-svg.plus-solid class="-ml-1 mr-2 h-5 w-5" />
                    New Category
                </x-button.icon-on-the-left-btn>
            </x-empty-states.simple>
        </div>
    @endif


    <x-modal.modal >
        @livewire('category-store')
    </x-modal.modal >

</div>
