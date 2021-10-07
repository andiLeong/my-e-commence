





<div class="my-20 px-4 md:px-0">

    <x-form.layout wire:submit.prevent="store">
        <x-slot name="slot">
            <div>

                @if(session()->has('need_create_address_before_checkout'))
                <div class="my-5 md:px-0 pr-4 md:w-1/2 w-full">
                    <x-alert type="danger">
                        {{ session('need_create_address_before_checkout') }}
                    </x-alert>
                </div>
                @endif


                <div>
                    <h3 class="text-lg leading-6 font-bold text-green-400 uppercase">
                        Create Your Address here
                    </h3>
                </div>

                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                    {{-- consignee --}}
                    <x-form.group  need-border="no">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Consignee" for="consignee"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="consignee"
                                name="consignee"
                                type="text"
                                placeholder="Consignee'name"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="consignee"/>
                        </x-slot>
                    </x-form.group>

                    {{-- provice --}}
                    <x-form.group need-border="no">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Province" for="province"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="province"
                                name="province"
                                placeholder="Province"
                                type="text"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="province"/>
                        </x-slot>
                    </x-form.group>

                    {{-- city --}}
                    <x-form.group need-border="no">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="City" for="city"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="city"
                                name="city"
                                placeholder="City"
                                type="text"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="city"/>
                        </x-slot>
                    </x-form.group>

                    {{-- district --}}
                    <x-form.group need-border="no">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="District" for="district"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="district"
                                name="district"
                                placeholder="District"
                                type="text"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="district"/>
                        </x-slot>
                    </x-form.group>

                    {{-- street --}}
                    <x-form.group need-border="no">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Street" for="street"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="street"
                                name="street"
                                placeholder="Street"
                                type="text"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="street"/>
                        </x-slot>
                    </x-form.group>

                    {{-- mobile number --}}
                    <x-form.group need-border="no">
                        <x-slot name="label">
                            <x-form.label class="sm:mt-px sm:pt-2" value="Mobile Number" for="mobile_number"/>
                        </x-slot>
                        <x-slot name="slot">
                            <x-form.input
                                wire:model.defer="mobile_number"
                                name="mobile_number"
                                placeholder="Mobile Number"
                                type="text"
                                class="block max-w-lg w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                            />
                            <x-form.error-msg name="mobile_number"/>
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
