

    <button
        wire:click.prevent="refund({{$orderId}})"
        wire:loading.attr="disabled"
        wire:loading.class="cursor-not-allowed"
        wire:target="refund"
        type="button"
        class="flex items-center text-blue-600 justify-center hover:text-blue-900">
        <x-svg.organic-spin class="hidden animate-spin h-4 mr-1 w-4 text-blue-500" wire:target="refund" wire:loading.class.remove="hidden"/>
        Refund

    </button>
