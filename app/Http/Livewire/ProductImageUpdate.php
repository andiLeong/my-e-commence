<?php
namespace App\Http\Livewire;

use App\Jobs\DeleteImage;
use App\Models\Image;
use App\Models\Product;
use App\Rules\UpdateProductImageCantGreaterThanOrigin;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImageUpdate extends Component
{
    use WithFileUploads;
    use FileUploaderHandler;

    public $product_id;
    public $product;
    public $cover;
    public $images;
    public $photos = [];
    public $images_ids;

    public function mount()
    {
        $this->fetch();
    }

    public function remove($id)
    {
        $image = Image::findOrFail($id);
        if( $this->images_ids->contains($id) && !is_null($image) && count($this->images_ids) > 1){
            $old_path = $image->getRawOriginal()['path'];
            $image->delete();
            $this->fetch();
            Bus::dispatch(New DeleteImage($old_path));
            $this->dispatchBrowserEvent('notification', ['msg' => 'Removed one product image!']);
        }else{
            $this->dispatchBrowserEvent('notification', [
                'msg' => 'Product must have at least one image' ,
                'type' => 'danger'
            ]);
        }
    }

    public function updateImages()
    {

        $data = $this->validate([
            'photos' => ['required',new UpdateProductImageCantGreaterThanOrigin(count($this->images_ids))],
            'photos.*' => 'image|max:2048',
        ]);

        $images = $this->upload($data['photos'], $this->getProductPath() );
        Image::persist($images , $this->product);
        $this->reset('photos');
        $this->fetch();
        $this->dispatchBrowserEvent('notification', ['msg' => 'Updated Product image!' ,]);
    }

    public function render()
    {
        return view('livewire.product-image-update');
    }

    protected function fetch(): void
    {
        $this->product = Product::with('images')->findOrFail($this->product_id);
        $this->images = $this->product->images;
        $this->images_ids = $this->product->images->pluck('id');
    }
}
