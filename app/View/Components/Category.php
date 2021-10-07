<?php

namespace App\View\Components;

use App\Models\Category as CategoryModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Category extends Component
{
    private $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = CategoryModel::latest()->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
//        compact($this->categories)
        return view('components.category',  [
            "categories" => $this->categories
            ]);
    }
}
