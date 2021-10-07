

@props([
'name',

])

@error($name)
<p class="mt-2 text-sm text-red-600" id="{{$name}}-error">{{ $message }}</p>
@enderror
