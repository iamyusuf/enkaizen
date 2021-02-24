<?php

namespace App\Jobs;

use App\Events\ImageHandled;
use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    private $userId;

    /**
     * Create a new job instance.
     *
     * @param $url
     * @param $userId
     */
    public function __construct($url, $userId)
    {
        //
        $this->url = $url;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        try {
            $file = file_get_contents($this->url);
            $name = substr($this->url, strrpos($this->url, '/') + 1);
            $fileName = time() . $name;
            Storage::put($fileName, $file);
            $newImage = new Image([
                'user_id' => $this->userId,
                'path'    => $fileName
            ]);
            $newImage->save();

            ImageHandled::broadcast($newImage);
        } catch (\Exception $e) {

        }
    }
}
