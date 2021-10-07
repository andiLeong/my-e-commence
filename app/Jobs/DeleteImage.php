<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param $image
     */
    public function __construct(public array|string $image)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param Filesystem $file
     * @return void
     */
    public function handle(Filesystem $file)
    {
        logger('deleting image from digitalocean');
        $file->delete($this->image);
    }
}
