<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use withPagination ;

    public $name;
    public $category_id = null;

    protected $listeners = [
        'addedToShoppingCart' => '$refresh',
    ];

    public function mount()
    {
//        $this->products = $this->load();
    }

    public function search()
    {
        $refresh;
    }

    public function resetPro()
    {
        $this->reset();
    }

    public function load( )
    {
        return Product::query()
            ->select(['id','name','price','cover','slug'])
            ->OnSale()
            ->latest()
            ->withShoppingCart(auth()->id())
            ->Filter($this->builderFilterArray())
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.product-index',[
            'products' => $this->load(),
        ]);
    }

    private function builderFilterArray()
    {
         if( is_null($this->category_id) && is_null($this->name) ){
             return [];
         }
         return [
                'category_id' => $this->category_id,
                'name' => $this->name,
        ];
    }
}
