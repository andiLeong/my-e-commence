
@props([
    'type' => 'button',
    'padding' => 'p-3',
    'bgcolor' => 'blue',
])

@php

    $bg_color_class = "bg-$bgcolor-600 hover:bg-$bgcolor-700 focus:ring-$bgcolor-500";

@endphp

<button

    {{ $attributes->merge(['class' => "inline-flex
                items-center
                $padding

                border
                rounded-full
                shadow-sm
                text-white
                $bg_color_class
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                "
]) }}

        type="{{$type}}"
>
    {{$slot}}
</button>
