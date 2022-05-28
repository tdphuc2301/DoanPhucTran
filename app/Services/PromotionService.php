<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Promotion;
use App\Repositories\PromotionRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class PromotionService
{
    private $promotionRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param PromotionRepository $promotionRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        PromotionRepository $promotionRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->promotionRepository = $promotionRepository;
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
        $fillableProperties = $this->promotionRepository->getFillableProperties();
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
        return $this->promotionRepository->paginateAllPromotion(
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
        return $this->promotionRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findPromotion(int $id): ?Model
    {
        return $this->promotionRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createPromotion(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $promotion = $this->promotionRepository->findOne($data['id']);
            $promotion = $this->promotionRepository->update($promotion, $data);
        } else {
            $promotion = $this->promotionRepository->save([
                'name' => $data['name'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($promotion->id)) {
            // Create alias
            event(new InsertNewRecord($promotion, $data['alias'] ?? $promotion->name));
            if (!empty($data['remove_images'])) {
                $this->removePromotionImage($promotion, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updatePromotionImage($promotion, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($promotion, $data['meta_seo']));
            }
            return $promotion;
        }
        return null;
    }

    /**
     * @param Promotion $promotion
     * @param UploadedFile $image
     * @param int $index
     * @return void
     */
    protected function updatePromotionImage(Promotion $promotion, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('promotion')
            ->setWidth(config('image.resize.promotion.width'))
            ->setHeight(config('image.resize.promotion.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removePromotionImage($promotion, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $promotion->id,
                    'model_type' => get_class($promotion),
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
     * @param Promotion $promotion
     * @param array $indexs
     * @return void
     */
    public function removePromotionImage(Promotion $promotion, array $indexs = []): void
    {
        if ($indexs) {
            $images = $promotion->getImagesByIndex($indexs);
        } else {
            $images = $promotion->images;
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
        $promotion = $this->promotionRepository->findOne($id);
        if ($promotion) {
            $this->promotionRepository->update($promotion, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
