








<x-home-layout>
    <div class="max-w-7xl mx-auto mt-16 ">

        @include('home.user._tab')

        @livewire('address-update',['address_id' => $address_id])

    </div>
</x-home-layout>


