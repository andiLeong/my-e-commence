
@props([
    'name',
    'type' => "text",
    'value' => '',
    'placeholder' => '',
])


<input
    type="{{$type}}"
    name="{{$name}}"
    id="{{$name}}"
    {{$attributes}}


    class="block w-full pr-10
    @error($name)
     border-red-300
     text-red-900
     placeholder-red-300
     focus:outline-none
     focus:ring-red-500
     focus:border-red-500
     @enderror
     sm:text-sm
     rounded-md"
    placeholder="{{$placeholder}}"
    value="{{$value}}"

    @error($name)
        aria-invalid="true"
        aria-describedby="email-error"
    @enderror

>
