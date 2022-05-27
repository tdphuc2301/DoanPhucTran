<?php

namespace App\Http\Services;

use App\Http\Responses\UploadImageResponse;
use App\Jobs\OptimizeImage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class UploadImageService
{
    protected ?string $module = null;
    protected ?int $width = null;
    protected ?int $height = null;
    protected ?string $dirPath = null;
    protected ?UploadedFile $image = null;
    private $logChannel;
    private $interventionImage;

    public function __construct()
    {
        $this->logChannel = config('upload.log_channel');
    }

    /**
     * @param string $module
     * @return self
     */
    public function setModule(string $module): self
    {
        $this->module = str_replace(' ', '', $module);
        return $this;
    }

    /**
     * @param int $width
     * @return self
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param int $height
     * @return self
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @param UploadedFile $image
     * @param string $dirPath
     * @param bool $isOptimize
     * @return UploadImageResponse
     */
    public function uploadImage(UploadedFile $image, string $dirPath = null, bool $isOptimize = true ): UploadImageResponse
    {
        try{
            $this->image = $image;
            $validateImage = $this->validateImage($this->image, config('upload.max_image_size'));
            if (!$validateImage->isSuccess()) {
                return $validateImage;
            }
            $this->interventionImage = Image::make($this->image);
            $this->dirPath = !empty($dirPath) ? $dirPath : $this->getUploadDirPath();
            if (!is_dir(public_path($this->dirPath))) {
                mkdir(public_path($this->dirPath), 0777, true);
            }
            $uploadInfo = [
                'file_name' => $this->getUploadFileName(),
                'size' => $this->image->getSize(),
                'ext' => $this->image->getClientOriginalExtension(),
                'path' => $this->getUploadImagePath(),
                'width' => $this->getUploadedImageWidth(),
                'height' => $this->getUploadedImageHeight()
            ];
            if ($this->isResize()) {
                $this->resizeImage();
            } else {
                $this->image->move($this->dirPath, $uploadInfo['file_name']);
            }
            if($isOptimize){
                dispatch(new OptimizeImage(renderImagePath($uploadInfo['path'])));
            }
            return new UploadImageResponse(config('upload.response_code.success'), '', $uploadInfo);
        }catch(\Exception $e){
            writeLog($this->logChannel,$e->getMessage(), LOG_LEVEL_ERROR);
            return new UploadImageResponse('upload.response_code.upload_fail', $e->getMessage());
        }
    }

    /**
     * @param string $path
     * @return UploadImageResponse
     */
    public function removeFile(string $path): UploadImageResponse
    {
        if (file_exists($path)){
            unlink($path);
            return new UploadImageResponse(config('upload.response_code.success'));
        }
        return new UploadImageResponse(config('upload.response_code.file_not_exist'));
    }

    /**
     * @return string
     */
    protected function getUploadDirPath(): string
    {
        $dirPath = sprintf(config('upload.upload_image_path'), $this->module, $this->width, $this->height);
        return preg_replace('/(\/){2,}/', '/', $dirPath);
    }

     /**
     * @return string
     */
    protected function getUploadImagePath(): string
    {
        return $this->dirPath . '/' . $this->getUploadFileName();
    }

    /**
     * @param UploadedFile $file
     * @param int $maxSize
     * @return mixed
     */
    public function validateImage(UploadedFile $image, int $maxSize): UploadImageResponse
    { // MB
        $maxSize = $maxSize * 1024 * 1024;
        $fileSize = $image->getSize();
        $extFile = $image->getClientOriginalExtension();

        if (!in_array($extFile, config('upload.allowed_image_extensions'))) {
            return new UploadImageResponse(config('upload.response_code.invalid_image_extension'));
        }

        if ($fileSize > $maxSize) {
            return new UploadImageResponse(
                config('upload.response_code.invalid_image_size'),
                sprintf(config('upload.response_message.invalid_image_size'), $maxSize)
            );
        }
        return new UploadImageResponse(config('upload.response_code.success'));
    }

     /**
     * @return bool
     */
    public function resizeImage(): bool
    {
        $width = $this->getUploadedImageWidth();
        $height = $this->getUploadedImageHeight();
        $path = $this->getUploadImagePath();
        $this->interventionImage->fit($width, $height)->save($path);

        return true;
    }

    /**
     * @return string
     */
    private function getUploadFileName(): string
    {
        return date('YmdHis') . '_' . str_replace(" ", "_",  $this->image->getClientOriginalName());
    }

    /**
     * @return bool
     */
    private function isResize(): bool
    {
        return !empty($this->width) || !empty($this->height);
    }

    /**
     * @return int
     */
    private function getUploadedImageWidth(): int
    {
        return !empty($this->width) ? $this->width : $this->interventionImage->width();
    }

    /**
     * @return int
     */
    private function getUploadedImageHeight(): int
    {
        return !empty($this->height) ? $this->height : $this->interventionImage->height();
    }
}
