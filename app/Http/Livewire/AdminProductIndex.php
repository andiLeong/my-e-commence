<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductIndex extends Component
{
    use WithPagination;



    public function updateOnSale($id,$value = null)
    {
        $value = is_null($value) ? true : false;
        if( is_bool($value) ){
            $product = Product::findOrFail($id);
            $product->update(['on_sale' => $value]);
            $refresh;
        }
    }

    public function goToAdd()
    {
        redirect()->route('admin.product.create');
    }

    public function render()
    {
        return view('livewire.admin-product-index',[
            'products' => Product::with(['category'])->latest()->paginate(10),
        ]);
    }
}
