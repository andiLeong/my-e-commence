@props([
    'isToDo' => false
])
<?php
$base_class = "relative px-6 py-3";
    if(!$isToDo){
        $base_class = "px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider";
    }

?>

<th {{ $attributes->merge(['class' => $base_class ]) }} scope="col" >
    {{$slot}}
</th>
