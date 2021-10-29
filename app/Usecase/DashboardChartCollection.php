<?php
namespace App\Usecase;


use Illuminate\Support\Collection;

class DashboardChartCollection
{
    protected $orders;
    protected $yearMonthCollection;
    protected $ordersCollection;


    public function __construct($orders)
    {
        $this->orders = $orders;
        $this->yearMonthCollection = Collection::retrieveMonths(6)->reverse()->values();
    }

    public function handle()
    {
        $this->ordersCollection = $this->orders
            ->map( fn($item) => $this->mapOrderCollecion($item) )
            ->keyBy('year_month')
            ->toArray();

        return $this->yearMonthCollection->map(fn($item) =>
            ['month' => $item, 'sum' => $this->getSum($item)]
        );
    }

    protected function mapOrderCollecion($item)
    {
        $data['year_month'] = $item['year'] . '-' . $item['month'];
        $data['sum'] = $item['sum_up'];
        return $data;
    }

    protected function getSum($item)
    {
        return isset($this->ordersCollection[$item]) ? $this->ordersCollection[$item]['sum'] : 0 ;
    }

}
