<div>

    <a wire:click.prevent="$set('showModal', true)" href="#" class="text-blue-600 hover:text-blue-900">Edit</a>

@if( $this->showModal )
    <x-modal.livewire-modal >

        <div>
            <div class="mt-3 text-center sm:mt-5">
                    <div>
                        <x-form.label for="category.name" value="category-name" class="text-lg"/>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <x-form.input name="category.name" wire:model.defer="category.name" />
                            <x-form.error-msg name="category.name" />
                        </div>
                    </div>
            </div>
        </div>


        <div class="mt-5 sm:mt-6">
            <button
                wire:click="update()"
                type="button"
                class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                submit
            </button>
        </div>

    </x-modal.livewire-modal>
@endif
</div>
