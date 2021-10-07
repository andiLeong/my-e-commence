
<x-home-layout>


    @livewire('pay-with-stripe' , [
        'paymentIntentSecret' => $paymentIntentSecret,
        'address_id' =>  $address_id,
        'carts_total_price' => $carts_total_price,
        'carts' => $carts,
    ])

</x-home-layout>
