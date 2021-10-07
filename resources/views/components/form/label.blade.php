@props([
    'value',
    'for' => ''
])


@php

if( $for == '')
{
    $for = strtolower($value);
}

@endphp

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }} for="{{$for}}">
    {{ $value ?? $slot }}
</label>


