<?php

namespace App\Jobs;

use App\Models\Image;
use App\Models\Product;
use App\Services\FileUploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct( public array $data , )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param FileUploadService $uploadService
     * @return void
     */
    public function handle( FileUploadService $uploadService )
    {
        logger('creating product');

        $path = config('filesystems.disks.digitalocean.product_path');
        $images = Image::upload( $this->data['photos'] , $path , $uploadService);
        $cover = Image::upload( [$this->data['cover']] , $path , $uploadService)[0];
        unset($this->data['photos']);
        $this->data['cover'] = $cover;

        Product::store($this->data, $images);

        logger('product created');
    }
}
