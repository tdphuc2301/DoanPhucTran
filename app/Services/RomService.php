<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Image;
use App\Models\Rom;
use App\Repositories\RomRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class RomService
{
    private $romRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param RomRepository $romRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        RomRepository $romRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->romRepository = $romRepository;
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
        $fillableProperties = $this->romRepository->getFillableProperties();
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
        return $this->romRepository->paginateAllRom(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllRom(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->romRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findRom(int $id): ?Model
    {
        return $this->romRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createRom(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $rom = $this->romRepository->findOne($data['id']);
            $rom = $this->romRepository->update($rom, $data);
        } else {
            $rom = $this->romRepository->save([
                'name' => $data['name'],
                'capacity' => $data['capacity'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($rom->id)) {
            // Create alias
            event(new InsertNewRecord($rom, $data['alias'] ?? $rom->name));
            if (!empty($data['remove_images'])) {
                $this->removeRomImage($rom, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateRomImage($rom, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($rom, $data['meta_seo']));
            }
            return $rom;
        }
        return null;
    }

    /**
     * @param Rom $rom
     * @param UploadedFile $image
     * @param int $index
     * @return void
     * @throws UploadImageException
     */
    protected function updateRomImage(Rom $rom, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('Rom')
            ->setWidth(config('image.resize.Rom.width'))
            ->setHeight(config('image.resize.Rom.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeRomImage($rom, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $rom->id,
                    'model_type' => get_class($rom),
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
     * @param Rom $rom
     * @param array $indexs
     * @param void
     */
    public function removeRomImage(Rom $rom, array $indexs = []): void
    {
        if ($indexs) {
            $images = $rom->getImagesByIndex($indexs);
        } else {
            $images = $rom->images;
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
        $rom = $this->romRepository->findOne($id);
        if ($rom) {
            $this->romRepository->update($rom, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
