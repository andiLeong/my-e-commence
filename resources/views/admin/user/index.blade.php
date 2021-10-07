
<x-admin-layout>
    <div class="py-6">

        @include('admin._welcome')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">

            @livewire('admin-user-index')

        </div>
    </div>

</x-admin-layout>

