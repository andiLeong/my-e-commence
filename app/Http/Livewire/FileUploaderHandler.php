<?php
namespace App\Http\Livewire;


use App\Models\Image;
use App\Services\FileUploadService;

trait FileUploaderHandler
{


    protected function getUserPath()
    {
        return config('filesystems.disks.digitalocean.user_path');
    }

    protected function getProductPath()
    {
        return config('filesystems.disks.digitalocean.product_path');
    }

    protected function upload(array $images,string $path)
    {
        return Image::upload($images, $path,resolve(FileUploadService::class));
    }
}
