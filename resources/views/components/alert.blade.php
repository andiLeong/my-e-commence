
@props([

    'type' => 'warning'

])

@php


if( $type == 'warning'){

    $containerClass = 'border-yellow-400  bg-yellow-50';
    $svgClass = 'text-yellow-400';
    $textClass = 'text-yellow-700';

}elseif ( $type == 'success' ){

    $containerClass = 'border-green-400  bg-green-50';
    $svgClass = 'text-green-400';
    $textClass = 'text-green-700';

}elseif ( $type == 'danger' ){

    $containerClass = 'border-red-400  bg-red-50';
    $svgClass = 'text-red-400';
    $textClass = 'text-red-700';
}

@endphp

<div {{ $attributes->merge(['class' => "$containerClass border-l-4 p-4 mt-10"]) }}  >
    <div class="flex">
        <div class="flex-shrink-0">

            <x-svg.exclamation-circle-solid class="h-5 w-5 {{$svgClass}}" />


        </div>
        <div class="ml-3">
            <p class="text-sm {{$textClass}}">
                {{$slot}}

            </p>
        </div>
    </div>
</div>
