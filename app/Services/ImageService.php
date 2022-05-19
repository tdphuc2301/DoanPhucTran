<?php

namespace App\Services;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;

class ImageService
{
    private $imageRepository;
    /**
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        ImageRepository $imageRepository
    ) {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @param array $data
     * @return ?Model
     */
    public function createImage(array $data): ?Model
    {
        return $this->imageRepository->save($data);
    }
}
