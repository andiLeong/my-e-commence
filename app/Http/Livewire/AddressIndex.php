<?php

namespace App\Http\Livewire;

use App\Models\Address;
use Livewire\Component;

class AddressIndex extends Component
{
    protected $listeners = [
        'addressDelete' => '$refresh',
    ];

    public function goToAdd()
    {
        redirect()->route('address.create');
    }

    public function render()
    {
        return view('livewire.address-index',[
            'addresses' => Address::NonOrder()->where('User_id',auth()->id())->get(),
        ]);
    }
}
