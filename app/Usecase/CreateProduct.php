<?php
namespace App\Usecase;

use \App\Http\Livewire\FileUploaderHandler;
use App\Models\Product;

class CreateProduct
{
    use FileUploaderHandler;

    public function handle(array $data)
    {
        logger('creating product');

        $images = $this->upload($data['photos'],$this->getProductPath());
        $cover = $this->upload([$data['cover']],$this->getProductPath())[0];
        unset($data['photos']);
        $data['cover'] = $cover;
        return Product::store($data, $images);

    }
}
