<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoryStore extends Component
{
    public $name;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', Rule::unique('categories', 'name')],
        ];
    }

    public function store()
    {
        Category::create($this->validate());
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('categoryCreated');
        $this->dispatchBrowserEvent('notification', [
            'msg' => 'Category Created Successfully !'
        ]);
        $this->name = '';
    }
    public function render()
    {
        return view('livewire.category-store');
    }
}
