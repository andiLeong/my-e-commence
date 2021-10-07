<?php
namespace App\Http\Livewire;

use App\Jobs\DeleteImage;
use App\Models\Product;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCoverUpdate extends Component
{
    use WithFileUploads;
    use FileUploaderHandler;

    public $product_id;
    public $product;
    public $cover;

    public function mount()
    {
        $this->product = Product::findOrFail($this->product_id);
    }

    public function updateCover()
    {
        $data = $this->validate(['cover' => 'required|image|max:2048',]);

        $cover = $this->upload([$data['cover']],  $this->getProductPath() )[0];
        $old_cover = $this->product->getRawOriginal()['cover'];
        if(!is_null($old_cover)){
            Bus::dispatch(New DeleteImage($old_cover));
        }
        $this->product->update(['cover' => $cover]);

        $this->reset('cover');
        $this->dispatchBrowserEvent('notification', [
            'msg' => 'Updated Product cover image!' ,
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.product-cover-update');
    }

}
