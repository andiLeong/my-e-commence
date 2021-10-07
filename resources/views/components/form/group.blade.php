
@props([

    'needBorder' => 'yes'

])

@php

if( $needBorder == 'yes' ){
    $borderClass = "sm:border-t sm:border-gray-200";
}else{
    $borderClass = "";
}
@endphp

<div
    {{ $attributes->merge(['class' => "sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start $borderClass sm:pt-5" ]) }}
>

    {{ $label  }}
    <div class="mt-1 sm:mt-0 sm:col-span-2">

        {{ $slot  }}

    </div>
</div>
