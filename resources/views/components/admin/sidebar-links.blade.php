

@props([
    'tag' => 'a',
])


@php


    $classes = "text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md";
@endphp

<{{$tag}} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{$tag}}>



