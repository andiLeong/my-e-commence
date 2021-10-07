

@props([
'name',
'rows' => 3,
'placeholder' => '',
])


<textarea
    id="{{$name}}"
    name="{{$name}}"
    rows="{{$rows}}"
    placeholder="{{$placeholder}}"
    {{ $attributes->merge(['class' => 'max-w-lg shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border border-gray-300 rounded-md']) }}
>
    {{$slot}}
</textarea>

