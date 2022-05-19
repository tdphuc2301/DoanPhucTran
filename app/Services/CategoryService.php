<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    private $categoryRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param CategoryRepository $categoryRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->categoryRepository = $categoryRepository;
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
        $fillableProperties = $this->categoryRepository->getFillableProperties();
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
        return $this->categoryRepository->paginateAllCategory(
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
        return $this->categoryRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findCategory(int $id): ?Model
    {
        return $this->categoryRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createCategory(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $category = $this->categoryRepository->findOne($data['id']);
            $category = $this->categoryRepository->update($category, $data);
        } else {
            $category = $this->categoryRepository->save([
                'name' => $data['name'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($category->id)) {
            // Create alias
            event(new InsertNewRecord($category, $data['alias'] ?? $category->name));
            if (!empty($data['remove_images'])) {
                $this->removeCategoryImage($category, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateCategoryImage($category, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($category, $data['meta_seo']));
            }
            return $category;
        }
        return null;
    }

    /**
     * @param Category $category
     * @param UploadedFile $image
     * @param int $index
     * @return void
     */
    protected function updateCategoryImage(Category $category, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('category')
            ->setWidth(config('image.resize.category.width'))
            ->setHeight(config('image.resize.category.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeCategoryImage($category, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $category->id,
                    'model_type' => get_class($category),
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
     * @param Category $category
     * @param array $indexs
     * @return void
     */
    public function removeCategoryImage(Category $category, array $indexs = []): void
    {
        if ($indexs) {
            $images = $category->getImagesByIndex($indexs);
        } else {
            $images = $category->images;
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
        $category = $this->categoryRepository->findOne($id);
        if ($category) {
            $this->categoryRepository->update($category, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
