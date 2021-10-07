<?php
namespace App\Http\Livewire;


use App\Usecase\CreateProduct;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductStore extends Component
{
    use WithFileUploads;


    public $cover;
    public $photos = [];
    public $name;
    public $price;
    public $stocks;
    public $description;
    public $on_sale = true;
    public $category_id;

    protected $messages = [
        'photos.max' => 'Only Max of 3 photos are allowed.',
        'category_id.required' => 'The Category is required',
    ];

    public function store()
    {
        $data = $this->validate([
            'cover' => 'required|image|max:2048',
            'name' => 'required|string|max:255|min:5|unique:products',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:255|min:5',
            'on_sale' => 'boolean|required',
            'price' => 'numeric|gt:0|required',
            'stocks' => 'numeric|integer|gt:0|required',
            'photos' => 'max:3',
            'photos.*' => 'image|max:2048',
        ]);

//        dd($data);
        $product = (new CreateProduct)->handle($data,);
        $this->reset();
        $this->dispatchBrowserEvent('remove-images');
        $this->dispatchBrowserEvent('notification', [
            'msg' => 'Product Crated, yeah!!' ,
            'type' => 'success'
        ]);

    }

    public function render()
    {
        return view('livewire.product-store');
    }
}
