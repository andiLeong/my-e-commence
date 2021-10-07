

<x-form.select {{$attributes}} autocomplete="address">
    <option value="null" selected="true" disabled="disabled">Please Choose One Address</option>

    @foreach($addresses as $address)
        <option value="{{$address->id}}">{{$address->consignee}}</option>
    @endforeach


    <option value="9999">dummy</option>
</x-form.select >




