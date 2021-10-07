<?php

namespace App\Http\Livewire;

use App\Models\Address;
use Livewire\Component;

class AddressUpdate extends Component
{
    public  $address_id;

    public Address $address;
    public $province;
    public $city;
    public $district;
    public $street;
    public $mobile_number;
    public $consignee;

    public function mount()
    {
        $this->address = Address::findOrFail($this->address_id);
        $this->province = $this->address->province;
        $this->city = $this->address->city;
        $this->district = $this->address->district;
        $this->street = $this->address->street;
        $this->mobile_number = $this->address->mobile_number;
        $this->consignee = $this->address->consignee;
    }

    public function update()
    {
        $data = $this->validate([
            'consignee' => 'required|max:255|min:3',
            'province' => 'required|max:255|min:3',
            'city' => 'required|max:255|min:3',
            'district' => 'required|max:255|min:3',
            'street' => 'required|max:255|min:3',
            'mobile_number' => 'required|digits:11',
        ]);

        $this->address->update($data);
        $this->dispatchBrowserEvent('notification', ['msg' => 'Updated Address!' ,]);

    }

    public function render()
    {
        return view('livewire.address-update');
    }
}
