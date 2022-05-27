<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Payment_method;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentMethodService
{
    private $paymentMethodRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param PaymentMethodRepository $paymentMethodRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        PaymentMethodRepository $paymentMethodRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->paymentMethodRepository = $paymentMethodRepository;
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
        $fillableProperties = $this->paymentMethodRepository->getFillableProperties();
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
        return $this->paymentMethodRepository->paginateAllPaymentMethod(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllPaymentMethod(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->paymentMethodRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findPaymentMethod(int $id): ?Model
    {
        return $this->paymentMethodRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createPaymentMethod(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $paymentMethod = $this->paymentMethodRepository->findOne($data['id']);
            $paymentMethod = $this->paymentMethodRepository->update($paymentMethod, $data);
        } else {
            $paymentMethod = $this->paymentMethodRepository->save([
                'name' => $data['name'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($paymentMethod->id)) {
            // Create alias
            event(new InsertNewRecord($paymentMethod, $data['alias'] ?? $paymentMethod->name));
            if (!empty($data['remove_images'])) {
                $this->removePaymentMethodImage($paymentMethod, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updatePaymentMethodImage($paymentMethod, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($paymentMethod, $data['meta_seo']));
            }
            return $paymentMethod;
        }
        return null;
    }

    /**
     * @param Payment_method $paymentMethod
     * @param UploadedFile $image
     * @param int $index
     * @return void
     */
    protected function updatePaymentMethodImage(Payment_method $paymentMethod, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('PaymentMethod')
            ->setWidth(config('image.resize.paymentMethod.width'))
            ->setHeight(config('image.resize.paymentMethod.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removePaymentMethodImage($paymentMethod, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $paymentMethod->id,
                    'model_type' => get_class($paymentMethod),
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
     * @param Payment_method $paymentMethod
     * @param array $indexs
     * @return void
     */
    public function removePaymentMethodImage(Payment_method $paymentMethod, array $indexs = []): void
    {
        if ($indexs) {
            $images = $paymentMethod->getImagesByIndex($indexs);
        } else {
            $images = $paymentMethod->images;
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
        $PaymentMethod = $this->paymentMethodRepository->findOne($id);
        if ($PaymentMethod) {
            $this->paymentMethodRepository->update($PaymentMethod, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
