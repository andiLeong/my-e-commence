<?php
namespace Tests;

class FileUploadServiceStub
{

    protected $paths = [];

    public function uploadMultipleFiles($path = 'a/pth', array $files = ['image1','image2'])
    {
        foreach( $files as $file)
        {
            $this->upload($path , $file);
        }
        return $this;
    }

    public function upload($path ,$file)
    {
//        $path = Storage::disk('digitalocean')->put($path, $file, 'public');
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
