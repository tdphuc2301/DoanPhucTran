<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Brand;
use App\Repositories\BrandRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class BrandService
{
    private $brandRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param BrandRepository $brandRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        BrandRepository $brandRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->brandRepository = $brandRepository;
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
        $fillableProperties = $this->brandRepository->getFillableProperties();
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
        return $this->brandRepository->paginateAllBrand(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllBrand(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->brandRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findBrand(int $id): ?Model
    {
        return $this->brandRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createBrand(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $brand = $this->brandRepository->findOne($data['id']);
            $brand = $this->brandRepository->update($brand, $data);
        } else {
            $brand = $this->brandRepository->save([
                'name' => $data['name'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($brand->id)) {
            // Create alias
            event(new InsertNewRecord($brand, $data['alias'] ?? $brand->name));
            if (!empty($data['remove_images'])) {
                $this->removeBrandImage($brand, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateBrandImage($brand, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($brand, $data['meta_seo']));
            }
            return $brand;
        }
        return null;
    }

    /**
     * @param Brand $brand
     * @param UploadedFile $image
     * @param int $index
     * @return void
     * @throws UploadImageException
     */
    protected function updateBrandImage(Brand $brand, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('brand')
            ->setWidth(config('image.resize.brand.width'))
            ->setHeight(config('image.resize.brand.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeBrandImage($brand, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $brand->id,
                    'model_type' => get_class($brand),
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
     * @param Brand $brand
     * @param array $indexs
     * @return void
     */
    public function removeBrandImage(Brand $brand, array $indexs = []): void
    {
        if ($indexs) {
            $images = $brand->getImagesByIndex($indexs);
        } else {
            $images = $brand->images;
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
        $brand = $this->brandRepository->findOne($id);
        if ($brand) {
            $this->brandRepository->update($brand, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
