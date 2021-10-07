<?php

namespace App\Http\Livewire;

use App\Models\OrderProduct;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderProducts extends Component
{
    use withPagination;

    public function render()
    {
        return view('livewire.admin-order-products',[
            'products' => OrderProduct::with('order')->latest()->paginate(10),
        ])->layout('layouts.admin');
    }


}
