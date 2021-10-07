
@props([
])

<button
    x-cloak
    {{$attributes}}
    type="button"
    class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 bg-green-500"
    x-data="{ on: @entangle($attributes->wire('model'))  }"
    role="switch"
    aria-checked="true"
    :aria-checked="on.toString()"
    @click="on = !on"
    x-state:on="Enabled"
    x-state:off="Not Enabled"
    :class="{ 'bg-green-500': on, 'bg-gray-200': !(on) }"
>
    <span class="sr-only">Use setting</span>
    <span
        class="pointer-events-none relative inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 translate-x-5"
        x-state:on="Enabled"
        x-state:off="Not Enabled"
        :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }">
      <span class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity opacity-0 ease-out duration-100" aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'opacity-0 ease-out duration-100': on, 'opacity-100 ease-in duration-200': !(on) }">

          <x-svg.x class="h-3 w-3 text-gray-400" />
      </span>
      <span class="absolute inset-0 h-full w-full flex items-center justify-center transition-opacity opacity-100 ease-in duration-200" aria-hidden="true" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'opacity-100 ease-in duration-200': on, 'opacity-0 ease-out duration-100': !(on) }">
           <x-svg.check class="h-3 w-3 text-green-500" />
      </span>
    </span>
</button>

