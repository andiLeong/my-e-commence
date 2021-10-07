<?php
namespace App\Services;

use Illuminate\Contracts\Filesystem\Filesystem;


class FileUploadService
{
    protected $paths = [];

    public function __construct(public Filesystem $file)
    {

    }

    public function uploadMultipleFiles($path, array $files): FileUploadService
    {
        foreach( $files as $file)
        {
            $this->upload($path , $file);
        }
        return $this;
    }

    public function upload($path ,$file)
    {
        $path = $this->file->put($path, $file, 'public');
        $this->push($path);
    }

    public function push($file)
    {
        $this->paths[] = $file;
    }

    public function getPaths()
    {
        return $this->paths;
    }


}
