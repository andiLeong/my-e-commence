
@props([
    'type' => 'success'
])

@php
    if($type == 'success'){
        $classes = 'bg-green-100 text-green-800';
    }else if($type == 'warning'){
        $classes = 'bg-yellow-100 text-yellow-800';
    }else if($type == 'danger'){
        $classes = 'bg-red-100 text-red-800';
    }
@endphp

<span
    {{ $attributes->merge(['class' => "px-2 inline-flex text-xs leading-5 font-semibold rounded-full $classes"]) }}
    >
    {{$slot}}
</span>
