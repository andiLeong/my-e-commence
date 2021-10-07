


<div>

    <div>
        <div class="my-3 text-gray-500 font-bold text-2xl">Create Category</div>
        <div class="mt-3 sm:mt-5">
            <div>
                <x-form.label for="name" value="name" class="text-lg"/>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <x-form.input
                        name="name"
                        wire:model.defer="name"
                        placeholder="Category Name" />
                    <x-form.error-msg name="name" />
                </div>
            </div>
        </div>
    </div>


    <div class="mt-5 sm:mt-6">
        <button
            wire:click="store()"
            type="button"
            class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
            submit
        </button>
    </div>

</div>
