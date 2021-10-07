


        <div class="my-20 px-4 md:px-0">

            <x-form.layout wire:submit.prevent="update">
                <x-slot name="slot">
                    <div>
                        <div>
                            <h3 class="text-lg leading-6 font-bold text-green-400 uppercase">
                                {{$user->name}}
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Update Your Profile Information
                            </p>
                        </div>

                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                            {{-- user name--}}
                            <x-form.group  need-border="no">
                                <x-slot name="label">
                                    <x-form.label class="sm:mt-px sm:pt-2" value="Name" for="name"/>
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


                            {{-- password--}}
                            <x-form.group need-border="no">
                                <x-slot name="label">
                                    <x-form.label class="sm:mt-px sm:pt-2" value="Password" for="password"/>
                                </x-slot>
                                <x-slot name="slot">
                                    <x-form.input
                                        wire:model.defer="password"
                                        name="password"
                                        placeholder="Your Password Here"
                                        type="password"
                                        class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                                    />
                                    <x-form.error-msg name="password"/>
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
