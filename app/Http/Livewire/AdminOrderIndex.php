<?php
namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderIndex extends Component
{

    use WithPagination;


    protected $listeners = [
        'orderIsRefunded' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.admin-order-index',[
            'orders' => Order::with(['user'])->latest()->paginate(10),
        ]);
    }
}
