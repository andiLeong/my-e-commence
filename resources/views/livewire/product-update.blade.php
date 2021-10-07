



<div>

    <x-form.layout wire:submit.prevent="update">
        <x-slot name="slot">
            <div>
                <div>
                    <h3 class="text-lg leading-6 font-bold text-green-400 uppercase">
                        {{$product->name}}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        This information will be displayed publicly so be careful what you share.
                    </p>
                </div>

                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                    {{-- product name --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Name"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="name"
                                name="name"
                                type="text"
                                placeholder="Product Name"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="name"/>
                        </x-slot>
                    </x-form.group>

                    {{-- product description --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Description"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.textarea wire:model.defer="description" name="description" rows="5"
                                             placeholder="Product Decription"/>
                            <p class="mt-2 text-sm text-gray-500">Write a product overview.</p>
                            <x-form.error-msg name="description"/>
                        </x-slot>
                    </x-form.group>

                </div>
            </div>

            <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Product Additional Information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Include category , brand , etc..
                    </p>
                </div>
                <div class="space-y-6 sm:space-y-5">

                    {{-- category --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Categories" for="category_id"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-category wire:model="category_id" id="category_id" name="category_id"/>
                            <x-form.error-msg name="category_id"/>
                        </x-slot>
                    </x-form.group>

                    {{-- on sale --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="On Sale" for="on_sale"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-button.toggle-btn wire:model="on_sale"/>
                            <x-form.error-msg name="on_sale"/>
                        </x-slot>
                    </x-form.group>

                    {{-- price --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Price"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="price"
                                name="price"
                                type="text"
                                placeholder="Product Price"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="price"/>
                        </x-slot>
                    </x-form.group>

                    {{-- stocks --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Stocks"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="stocks"
                                name="stocks"
                                type="text"
                                placeholder="Product Stocks"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="stocks"/>
                        </x-slot>
                    </x-form.group>

                </div>

            </div>
        </x-slot>

        <x-slot name="button">
            <div class="flex justify-end">

                <x-button.icon-on-the-left-btn
                    class="ml-3"
                    type="submit"
                    wire:target="store"
                    wire:loading.class="cursor-not-allowed"
                    wire:loading.attr="disabled"
                >
                    <x-svg.spin class="hidden text-white" wire:target="update" wire:loading.class.remove="hidden"/>
                    Save
                </x-button.icon-on-the-left-btn>

            </div>
        </x-slot>

    </x-form.layout>

</div>
