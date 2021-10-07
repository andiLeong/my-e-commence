<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProductUpdate extends Component
{
    public  $product_id;
    public Product $product;
    public $name;
    public $description;
    public $price;
    public $stocks;
    public $on_sale;
    public $category_id;

    public function mount()
    {
        $this->product = Product::findOrFail($this->product_id);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->stocks = $this->product->stocks;
        $this->on_sale = $this->product->on_sale;
        $this->category_id = $this->product->category_id;
    }


    public function update()
    {
        $data = $this->validate([
            'name' => ['required','string','max:255','min:5',Rule::unique('products', 'name')->ignore($this->product)], //ignore your own ]
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:5',
            'on_sale' => 'boolean|required',
            'price' => 'numeric|gt:0|required',
            'stocks' => 'numeric|integer|gt:0|required',
        ]);

        $this->product->update($data);
        $this->dispatchBrowserEvent('notification', [
            'msg' => 'Updated Product!' ,
            'type' => 'success'
        ]);
    }


    public function render()
    {
        return view('livewire.product-update');
    }
}
