<?php

namespace App\Models;

use App\Services\FileUploadService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public function getPathAttribute($value)
    {
        return Storage::disk('digitalocean')->url($value);
    }

    public static function upload( array $images , $path, $uploadService)
    {
        return $uploadService->uploadMultipleFiles($path , $images)->getPaths();
    }

//    public function upload($image)
//    {
//        return Storage::disk('digitalocean')
//            ->putFile(
//                config('filesystems.digitalocean.path'),
//                $image,
//                'public'
//            );
//    }

    public function imageable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public static function persist(array $paths , Model $model)
    {
        $data = collect($paths)->map(function ($item) use($model){
            $data['path'] = $item;
            $data['imageable_type'] = $model->getMorphClass();
            $data['imageable_id'] = $model->id;
            $data['created_at'] = $data['updated_at'] = now();
            return $data;
        })->toArray();
        return self::insert($data);
    }

}
