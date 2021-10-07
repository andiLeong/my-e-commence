<?php

namespace App\Http\Livewire;

use App\Models\Address;
use Livewire\Component;

class AddressDestroy extends Component
{

    public $showModal = false;
    public Address $address;

    public function destroy()
    {
        $this->address->delete();
        $this->showModal = false;
        $this->dispatchBrowserEvent('close-dropdown');
        $this->emit('addressDelete');
        $this->dispatchBrowserEvent('notification', ['msg' => 'Deleted Address!']);
    }

    public function render()
    {
        return view('livewire.address-destroy');
    }
}
