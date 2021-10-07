

<x-form.select {{$attributes}} autocomplete="category">
    <option value="null" selected="true" disabled="disabled">Please Choose One Category</option>

    @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
    @endforeach

</x-form.select >
