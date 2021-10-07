<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoryUpdate extends Component
{
    public Category $category;
    public $showModal = false;


    protected function rules()
    {
        return [
            'category.name' => [
                'required',
                'string',
                Rule::unique('categories', 'name')->ignore($this->category)
            ],
        ];
    }

    public function update()
    {
        $this->validate();
        $this->category->save();
        $this->showModal = false;
        $this->dispatchBrowserEvent('close-dropdown');
        $this->emit('categoryUpdated');

        $this->dispatchBrowserEvent('notification', [
            'msg' => 'Updated Category!' ,
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.category-update');
    }
}
