<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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

        $orders = Order::query()->SumupSalesGroupByYearMonth()->get();
        $orders =  $orders->map(function($item){
            $item['month'] = Carbon::parse($item['year_month'])->shortMonthName;
            return $item;
        })
        ->sortBy( fn($product) => strtotime( $product['year_month']) )
        ->values();

        $this->labels = $orders->pluck('month');
        $this->sumUp = $orders->pluck('sum_up');
        $this->displayChart = true;

    }


    public function render()
    {
        return view('livewire.dashboard',[

        ])->layout('layouts.admin');
    }
}
