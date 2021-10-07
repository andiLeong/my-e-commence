<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryIndex extends Component
{

    use WithPagination;

    private $categories;
    protected $listeners = [
        'categoryUpdated' => '$refresh',
        'categoryCreated' => '$refresh'
    ];


    public function load()
    {
        return Category::withProductsCount()->latest('product_counts')->paginate(10);
    }

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.admin-category-index',[
            'categories' => Category::withProductsCount()->latest('product_counts')->paginate(10),
        ]);
    }
}
