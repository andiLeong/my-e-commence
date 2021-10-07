<?php

namespace App\Http\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AddressStore extends Component
{

    public $consignee;
    public $province;
    public $city;
    public $district;
    public $street;
    public $mobile_number;

    public function store()
    {
        $data = $this->validate([
            'consignee' => 'required|max:255|min:3',
            'province' => 'required|max:255|min:3',
            'city' => 'required|max:255|min:3',
            'district' => 'required|max:255|min:3',
            'street' => 'required|max:255|min:3',
            'mobile_number' => 'required|digits:11',
        ]);


        $user = auth()->user();
        if( $user->address->count() >=  Address::ADDRESS_LIMIT  ){
             $this->dispatchBrowserEvent('notification', [
                'msg' => 'You hace reached the max shipping address limit, please delete some.' ,
                'type' => 'danger'
            ]);
            return;
        }

        (new Address)->addBy($user,$data);
        $this->reset();

        if(Cache::has('redirect_back_to_checkout')){
            Cache::forget('redirect_back_to_checkout');
            return redirect()->route('checkout.index');
        }
        $this->dispatchBrowserEvent('notification', ['msg' => 'Address Created!' ,]);
    }

    public function render()
    {
        return view('livewire.address-store');
    }
}
