<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Branch;
use App\Repositories\BranchRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class BranchService
{
    private $branchRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param BranchRepository $branchRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        BranchRepository $branchRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->branchRepository = $branchRepository;
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
        $fillableProperties = $this->branchRepository->getFillableProperties();
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
        return $this->branchRepository->paginateAllBranch(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllBranch(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->branchRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findBranch(int $id): ?Model
    {
        return $this->branchRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createBranch(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $branch = $this->branchRepository->findOne($data['id']);
            $data['address'] = $data['search_address'];
            $data['long'] = $data['longitude'];
            $data['lat'] = $data['latitude'];
            $branch = $this->branchRepository->update($branch, $data);
        } else {
            $branch = $this->branchRepository->save([
                'name' => $data['name'],
                'address' => $data['search_address'],
                'long' => $data['longitude'],
                'lat' => $data['latitude'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($branch->id)) {
            // Create alias
            event(new InsertNewRecord($branch, $data['alias'] ?? $branch->name));
            if (!empty($data['remove_images'])) {
                $this->removeBranchImage($branch, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateBranchImage($branch, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($branch, $data['meta_seo']));
            }
            return $branch;
        }
        return null;
    }

    /**
     * @param Branch $branch
     * @param UploadedFile $image
     * @param int $index
     * @return void
     * @throws UploadImageException
     */
    protected function updateBranchImage(Branch $branch, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('branch')
            ->setWidth(config('image.resize.branch.width'))
            ->setHeight(config('image.resize.branch.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeBranchImage($branch, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $branch->id,
                    'model_type' => get_class($branch),
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
     * @param Branch $branch
     * @param array $indexs
     * @return void
     */
    public function removeBranchImage(Branch $branch, array $indexs = []): void
    {
        if ($indexs) {
            $images = $branch->getImagesByIndex($indexs);
        } else {
            $images = $branch->images;
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
        $branch = $this->branchRepository->findOne($id);
        if ($branch) {
            $this->branchRepository->update($branch, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
