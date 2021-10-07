

<x-home-layout>

    <div class="bg-white">
        <div class="mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <!-- Product -->


            @livewire('product-show', ['slug' => $slug ] ,  key('product-show-'.$product->id))
        </div>
    </div>

</x-home-layout>




