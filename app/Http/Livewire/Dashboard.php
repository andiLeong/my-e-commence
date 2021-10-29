<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Usecase\DashboardChartCollection;
use Illuminate\Support\Collection;
use Livewire\Component;

class Dashboard extends Component
{

    public $userCounter;
    public $orderCounter;
    public $orderProductCounter;
    public $labels;
    public $sumUp;
    public $displayChart = false;

    public function mount()
    {

    }

    public function load()
    {
        $this->userCounter = User::query()
            ->BeforeLastThirtyDaysRaw()
            ->selectRaw("count('id') as total_count")
            ->first();

        $this->orderCounter = Order::query()
            ->paid()
            ->BeforeLastThirtyDaysRaw()
            ->selectRaw("count('id') as total_count")
            ->first();

        $this->orderProductCounter = OrderProduct::query()
            ->whereHas('order' , fn($query) => $query->paid() )
            ->BeforeLastThirtyDaysRaw()
            ->selectRaw("count('id') as total_count")
            ->first();
    }

    public function loadChart()
    {
        $orders = Order::SumOrderSalesForLast(6)->get();
        $data = (new DashboardChartCollection($orders))->handle();

        $this->labels = $data->pluck('month');
        $this->sumUp = $data->pluck('sum');
        $this->displayChart = true;

    }



    public function render()
    {
        return view('livewire.dashboard',[

        ])->layout('layouts.admin');
    }
}
