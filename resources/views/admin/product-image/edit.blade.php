

<x-admin-layout>


    <div class="py-6">

        @include('admin._welcome')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">


            @livewire('product-image-update' , ['product_id' => $product_id])

        </div>
    </div>


</x-admin-layout>

