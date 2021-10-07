
@props([

    'active',
    'href' => '#',
])

@php
    $classes = ($active ?? false)
                ? 'border-blue-500 text-blue-600'
                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200';
@endphp

<a
    {{ $attributes->merge(['class' => $classes. " whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm " ]) }}
    href="{{$href}}"
>
    {{$slot}}
</a>
