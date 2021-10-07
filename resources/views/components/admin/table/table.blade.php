
<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) }}>
    <thead class="bg-gray-50">
        <tr>
            {{$thead}}
        </tr>
    </thead>
    <tbody>
    {{$slot}}
    </tbody>
</table>
