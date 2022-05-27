<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Image;
use App\Models\Ram;
use App\Repositories\RamRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class RamService
{
    private $ramRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param RamRepository $ramRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        RamRepository $ramRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->ramRepository = $ramRepository;
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
        $fillableProperties = $this->ramRepository->getFillableProperties();
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
        return $this->ramRepository->paginateAllRam(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllRam(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->ramRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findRam(int $id): ?Model
    {
        return $this->ramRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createRam(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $ram = $this->ramRepository->findOne($data['id']);
            $ram = $this->ramRepository->update($ram, $data);
        } else {
            $ram = $this->ramRepository->save([
                'name' => $data['name'],
                'capacity' => $data['capacity'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($ram->id)) {
            // Create alias
            event(new InsertNewRecord($ram, $data['alias'] ?? $ram->name));
            if (!empty($data['remove_images'])) {
                $this->removeRamImage($ram, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateRamImage($ram, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($ram, $data['meta_seo']));
            }
            return $ram;
        }
        return null;
    }

    /**
     * @param Ram $ram
     * @param UploadedFile $image
     * @param int $index
     * @return void
     * @throws UploadImageException
     */
    protected function updateRamImage(Ram $ram, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('ram')
            ->setWidth(config('image.resize.ram.width'))
            ->setHeight(config('image.resize.ram.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeRamImage($ram, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $ram->id,
                    'model_type' => get_class($ram),
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
     * @param Ram $ram
     * @param array $indexs
     * @return void
     */
    public function removeramImage(Ram $ram, array $indexs = []): void
    {
        if ($indexs) {
            $images = $ram->getImagesByIndex($indexs);
        } else {
            $images = $ram->images;
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
        $ram = $this->ramRepository->findOne($id);
        if ($ram) {
            $this->ramRepository->update($ram, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
