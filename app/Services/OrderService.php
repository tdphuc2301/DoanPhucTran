<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\order;
use App\Models\Order_detail;
use App\Repositories\OrderRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    private $orderRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param OrderRepository $orderRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->orderRepository = $orderRepository;
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
        $fillableProperties = $this->orderRepository->getFillableProperties();
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
        return $this->orderRepository->paginateAllorder(
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
        return $this->orderRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findorder(int $id): ?Model
    {
        return $this->orderRepository->findOne($id, ['images', 'metaseo', 'alias']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createorder(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $order = $this->orderRepository->findOne($data['id']);
            $order = $this->orderRepository->update($order, $data);
        } else {
            
            $order = $this->orderRepository->save([
                'customer_id' => $data['customer_id'],
                'promotion_id' => $data['promotion_id'],
                'code' => $data['code'],
                'note' => $data['note'],
                'total_price' => $data['total_price'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
            
            $order_detail = new Order_detail();
            $order_detail->product_id = $data['product_id'];
            $order_detail->order_id = $order->id;
            $order_detail->quantity = $data['quantity'];
            $order_detail->price = $data['price'];


        }

        if (!empty($order->id)) {
            // Create alias
            event(new InsertNewRecord($order, $data['alias'] ?? $order->name));
            if (!empty($data['remove_images'])) {
                $this->removeorderImage($order, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateorderImage($order, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($order, $data['meta_seo']));
            }
            return $order;
        }
        return null;
    }

    /**
     * @param Order $order
     * @param UploadedFile $image
     * @param int $index
     * @return void
     */
    protected function updateorderImage(Order $order, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('order')
            ->setWidth(config('image.resize.order.width'))
            ->setHeight(config('image.resize.order.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removeorderImage($order, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $order->id,
                    'model_type' => get_class($order),
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
     * @param Order $order
     * @param array $indexs
     * @return void
     */
    public function removeorderImage(Order $order, array $indexs = []): void
    {
        if ($indexs) {
            $images = $order->getImagesByIndex($indexs);
        } else {
            $images = $order->images;
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
        $order = $this->orderRepository->findOne($id);
        if ($order) {
            $this->orderRepository->update($order, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
