


<div>

    <button
        @click.prevent="$wire.destroy()"
{{--        wire:click.prevent="destroy()"--}}
            wire:loading.class="cursor-not-allowed"
            wire:loading.attr="disabled"
            type="button" class="-m-2 p-2 inline-flex text-gray-400 hover:text-gray-500">
        <span class="sr-only">Remove</span>
        <x-svg.x class="h-5 w-5" />
    </button>


</div>
