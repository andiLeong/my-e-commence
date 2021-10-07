<?php

namespace App\View\Components;

use App\Models\Address as AddressModel;
use Illuminate\View\Component;

class Address extends Component
{
    private $address;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->address = AddressModel::NonOrder()->where('user_id', auth()->id())->latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.address',  ["addresses" => $this->address]);
    }
}
