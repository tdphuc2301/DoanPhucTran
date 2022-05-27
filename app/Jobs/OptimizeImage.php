<?php

namespace App\Jobs;

use App\Http\Services\UploadImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OptimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $fromPath
     * @param string $toPath
     * @param bool $isDelete
     * @return void
     */
    protected $fromPath;
    protected $toPath;
    protected $isDelete;
    public function __construct(string $fromPath, string $toPath = null, bool $isDelete = false)
    {
        $this->fromPath = $fromPath;
        $this->toPath = $toPath;
        $this->isDelete = $isDelete;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->toPath = !empty($this->toPath) ? $this->toPath : $this->fromPath;
            writeLog('log_upload_image', "Start optimize image from $this->fromPath to $this->toPath");
            
            \Tinify\setKey(config('upload.tinify_key'));
            $source = \Tinify\fromFile($this->fromPath);
            $source->toFile($this->toPath);
            writeLog('log_upload_image', "Done start optimize image from $this->fromPath to $this->toPath");
           
            if ($this->isDelete) {
                // remove old image
                app(UploadImageService::class)->removeFile($this->fromPath);
            }
        } catch (\Exception $e) {
            writeLog('log_upload_image', $e->getMessage(), LOG_LEVEL_ERROR);
        }
    }
}
