


<div
    x-data="{
            show: false,
            msg: '',
            type: ''
        }"
    x-cloak
    x-show="show"
    @notification.window="
        msg = $event.detail.msg;
        type = $event.detail.type ?? 'success';
        console.log( $event.detail.msg );
        show = true;
        setTimeout(() => {
                show = false
        }, 3000);
        "
    aria-live="assertive" class="z-30 fixed inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
    <div class="w-full flex flex-col items-center space-y-4 sm:items-end">

        <div
            x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            :class="{ 'bg-green-100': type === 'success' , 'bg-red-100': type === 'danger' ,  'bg-yellow-100': type === 'warning' }"
            class="max-w-sm w-full  shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">

                        <template x-if="type === 'success'">
                            <x-svg.check-circle-solid class="h-6 w-6 text-green-400" />
                        </template>

                        <template x-if="type === 'danger'">
                            <x-svg.x-circle-solid class="h-6 w-6 text-red-400" />
                        </template>

                        <template x-if="type === 'warning'">
                            <x-svg.exclamation-circle-solid class="h-6 w-6 text-yellow-400" />
                        </template>

                    </div>
                    <div class="ml-3 w-0 flex-1 ">
                        <p
                            :class="{ 'text-green-600': type === 'success' , 'text-red-600': type === 'danger' ,  'text-yellow-600': type === 'warning' }"
                            class="mt-1 text-sm font-bold" x-text="msg">
                        </p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button
                            @click="show = false"
                            :class="{ 'text-green-400': type === 'success' , 'text-red-400': type === 'danger' ,  'text-yellow-400': type === 'warning' }"
                            class="rounded-md inline-flex text-green-400 hover:text-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <span class="sr-only">Close</span>
                            <x-svg.x class="h-5 w-5" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
