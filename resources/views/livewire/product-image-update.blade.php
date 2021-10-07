


<div>

    <x-form.layout wire:submit.prevent="updateImages">
        <x-slot name="slot">
            <div>
                <div>
                    <h3 class="text-lg leading-6 font-bold text-green-400 uppercase">
                        {{$product->name}}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Update product images here
                    </p>
                    <div class="mt-5 md:flex md:space-x-3">

                        @foreach($images as $image)
                            <div class="relative pt-4 " wire:target="remove" wire:loading.class="animate-pulse" wire:key="image.{{  $image->getRawOriginal()['path']  }}">
                                <x-button.circular-btn
                                    wire:click="remove('{{$image->id}}')"
                                    wire:target="remove"
                                    wire:loading.attr="disabled"
                                    class="md:absolute md:-top-1.5 md:-right-1" padding="p-1" bgcolor="red"
                                >
                                    <x-svg.x class="h-2 w-2"  />
                                </x-button.circular-btn>
                                <img class="h-96 rounded-2xl" src="{{ $image->path }}" >
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                    {{-- Product images --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Cover"/>
                        </x-slot>
                        <x-slot name="slot">
                            <div class="flex items-center">
                                <label
                                    for="photos"
                                    wire:loading.class="cursor-not-allowed"
                                    class="cursor-pointer flex items-center ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <x-svg.spin class="text-green-400 hidden" wire:target="photos" wire:loading.class.remove="hidden"/>
                                    Upload
                                </label>
                                <x-form.input wire:target="photos" wire:loading.attr="disabled" wire:model.defer="photos" type="file" name='photos' class="hidden" multiple/>
                            </div>
                            <x-form.error-msg name="photos.*" />
                            <x-form.error-msg name="photos" />
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
                    wire:target="updateImages"
                    wire:target="updateImages"
                    wire:loading.class="cursor-not-allowed"
                    wire:loading.attr="disabled"
                >
                    <x-svg.spin class="hidden text-white" wire:target="updateImages" wire:loading.class.remove="hidden"/>
                    Save
                </x-button.icon-on-the-left-btn>

            </div>
        </x-slot>

    </x-form.layout>

</div>
