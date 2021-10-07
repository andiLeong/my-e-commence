


<div>

    <x-form.layout wire:submit.prevent="update">
        <x-slot name="slot">
            <div>
                <div>
                    <h3 class="text-lg leading-6 font-bold text-green-400 uppercase">
                        {{$user->name}}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Update User Information
                    </p>
                </div>

                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                    {{-- user name --}}
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

                    {{-- user email --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Email"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="email"
                                name="email"
                                type="text"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="email"/>
                        </x-slot>
                    </x-form.group>

                    {{-- User Profile --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Profile picture" for="photo"/>
                        </x-slot>
                        <x-slot name="slot">
                            <div class="flex items-center">
                                  <span class="h-20 w-20 rounded-full overflow-hidden bg-gray-100">
                                     @if ($photo)
                                          <img class="h-full w-full" src="{{ $photo->temporaryUrl() }}">
                                      @else
                                          @if ( $profile_image )
                                              <img class="h-full w-full" src="{{ $profile_image }}">
                                          @else
                                              <x-svg.photograph class="h-full w-full text-gray-300"/>
                                          @endif
                                      @endif
                                  </span>
                                <label
                                    for="photo"
                                    wire:loading.class="cursor-not-allowed"
                                    class="cursor-pointer flex items-center ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <x-svg.spin class="text-green-400 hidden" wire:target="photo" wire:loading.class.remove="hidden"/>
                                    Upload
                                </label>
                                <x-form.input wire:target="photo" wire:loading.attr="disabled" wire:model.defer="photo" type="file" name='photo' class="hidden"/>
                            </div>
                            <x-form.error-msg name="photo"/>
                        </x-slot>
                    </x-form.group>

                    {{-- is admin --}}
                    <x-form.group>
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Is Admin" for="is_admin"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-button.toggle-btn wire:model="is_admin"/>
                            <x-form.error-msg name="is_admin"/>
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
                    wire:target="update"
                    wire:target="photo"
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
