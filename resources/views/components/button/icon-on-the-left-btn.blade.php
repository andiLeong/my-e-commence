
@props([
    'type' => 'button',
    'background' => 'bg-blue-600',
    'hover' => 'hover:bg-blue-700',
])

<button
    {{ $attributes->merge([
        'class' => "inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white $background $hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    ]) }}
    type="{{$type}}"
>

{{$slot}}

</button>
