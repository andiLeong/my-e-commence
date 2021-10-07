

<button
    wire:click.prevent="increase()"
    wire:loading.class="cursor-not-allowed"
    wire:loading.attr="disabled"
    type="button"
    class="px-3 rounded bg-gray-300 text-xm text-gray-500">
    +
</button>
