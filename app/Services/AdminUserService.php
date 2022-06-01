<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\User;
use App\Repositories\AdminUserRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminUserService
{
    private $adminUserRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param AdminUserRepository $adminUserRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        AdminUserRepository $adminUserRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->adminUserRepository = $adminUserRepository;
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
        $fillableProperties = $this->adminUserRepository->getFillableProperties();
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
        return $this->adminUserRepository->paginateAllAdminUser(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllCategories(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->adminUserRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findAdminUser(int $id): ?Model
    {
        return $this->adminUserRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createAdminUser(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $adminUser = $this->adminUserRepository->findOne($data['id']);
            $adminUser = $this->adminUserRepository->update($adminUser, $data);
        } else {
            $adminUser = $this->adminUserRepository->save([
                'name' => $data['name'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($adminUser->id)) {
            // Create alias
            event(new InsertNewRecord($adminUser, $data['alias'] ?? $adminUser->name));
            if (!empty($data['remove_images'])) {
                $this->removeAdminUserImage($adminUser, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateAdminUserImage($adminUser, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($adminUser, $data['meta_seo']));
            }
            return $adminUser;
        }
        return null;
    }

    /**
     * @param User $adminUser
     * @param UploadedFile $image
     * @param int $index
     * @return void
     */
    protected function updateAdminUserImage(User $adminUser, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('adminUser')
            ->setWidth(config('image.resize.adminUser.width'))
            ->setHeight(config('image.resize.adminUser.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeAdminUserImage($adminUser, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $adminUser->id,
                    'model_type' => get_class($adminUser),
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
     * @param User $adminUser
     * @param array $indexs
     * @return void
     */
    public function removeAdminUserImage(User $adminUser, array $indexs = []): void
    {
        if ($indexs) {
            $images = $adminUser->getImagesByIndex($indexs);
        } else {
            $images = $adminUser->images;
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
        $adminUser = $this->adminUserRepository->findOne($id);
        if ($adminUser) {
            $this->adminUserRepository->update($adminUser, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
