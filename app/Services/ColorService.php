<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Color;
use App\Models\Image;
use App\Repositories\ColorRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class ColorService
{
    private $colorRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param ColorRepository $colorRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        ColorRepository $colorRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->colorRepository = $colorRepository;
        $this->uploadImageService = $uploadImageService;
        $this->imageRepository = $imageRepository;
    }

    public function paginateAll(
        int $page,
        int $limit,
        array $data = [],
        string $sortKey,
        int $sortValue
    ): LengthAwarePaginator {
        $filter = [];
        $fillableProperties = $this->colorRepository->getFillableProperties();
        foreach ($data as $key => $value) {
            if (in_array($key, $fillableProperties)) {
                $filter[$key] = $value;
            }
        }
        if(!empty($data['keyword'])){
            $filter['search'] = [
                'operator' => 'LIKE',
                'value' => "%". $data['keyword']. "%"
            ];
        }
        $searchCriteria = [
            'page' => $page,
            'limit' => $limit,
            'sort' => $sortValue ? $sortKey : "-$sortKey",
            "filter" => $filter,
        ];
        return $this->colorRepository->paginateAllColor(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllColor(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->colorRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findColor(int $id): ?Model
    {
        return $this->colorRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createColor(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $color = $this->colorRepository->findOne($data['id']);
            $color = $this->colorRepository->update($color, $data);
        } else {
            $color = $this->colorRepository->save([
                'name' => $data['name'],
                'color_code' => $data['color_code'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($color->id)) {
            // Create alias
            event(new InsertNewRecord($color, $data['alias'] ?? $color->name));
            if (!empty($data['remove_images'])) {
                $this->removeColorImage($color, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateColorImage($color, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($color, $data['meta_seo']));
            }
            return $color;
        }
        return null;
    }

    /**
     * @param Color $color
     * @param UploadedFile $image
     * @param int $index
     * @return void
     * @throws UploadImageException
     */
    protected function updateColorImage(Color $color, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('Color')
            ->setWidth(config('image.resize.Color.width'))
            ->setHeight(config('image.resize.Color.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeColorImage($color, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $color->id,
                    'model_type' => get_class($color),
                    'index' => $index,
                ],
                [
                    'width' => $uploadImage['width'] ?? null,
                    'height' => $uploadImage['height'] ?? null,
                    'size' => $uploadImage['size'] ?? null,
                    'path' => $uploadImage['path'] ?? null,
                ]
            );
        } else {
            throw new UploadImageException($uploadImage->getMessage());
        }
    }

    /**
     * @param Color $color
     * @param array $indexs
     * @return void
     */
    public function removeColorImage(Color $color, array $indexs = []): void
    {
        if ($indexs) {
            $images = $color->getImagesByIndex($indexs);
        } else {
            $images = $color->images;
        }
        /**
         * @param Image $image
         */
        foreach ($images as $image) {
            $this->uploadImageService->removeFile(public_path($image->path));
            $image->delete();
        }
    }

    /**
     * @param int $id
     * @param bool $status
     * @return bool
     */
    public function changeStatus(int $id, bool $status): bool
    {
        $color = $this->colorRepository->findOne($id);
        if ($color) {
            $this->colorRepository->update($color, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
