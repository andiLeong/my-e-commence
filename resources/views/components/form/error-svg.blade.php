
@props([
'name',

])

@error($name)
    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <x-svg.exclamation-circle-solid class="h-5 w-5 text-red-500" />
    </div>


@enderror
