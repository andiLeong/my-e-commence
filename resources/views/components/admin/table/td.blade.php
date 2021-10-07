
@props([
'isFirst' => false,
'isToDo' => false
])

<?php
$base_class = "px-6 py-4 whitespace-nowrap text-sm text-gray-900 ";
if($isFirst){
    $base_class .= "font-medium";
}

if($isToDo){
    $base_class = "px-6 py-4 whitespace-nowrap text-right text-sm font-medium";
}
?>

<td {{ $attributes->merge(['class' => $base_class ]) }} >
    {{$slot}}
</td>
