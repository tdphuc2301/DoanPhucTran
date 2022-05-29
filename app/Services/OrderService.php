<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\order;
use App\Models\Order_detail;
use App\Models\Payment;
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
            // Save order
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

            // Save order detail
            $order_detail = new Order_detail();
            $order_detail->product_id = $data['product_id'];
            $order_detail->order_id = $order->id;
            $order_detail->quantity = $data['quantity'];
            $order_detail->price = $data['price'];
            $order_detail->save();

            // Save payment
            $payment = new Payment();
            $payment->payment_code = $this->generateRandomString();
            if($data['type_payment_method'] == 1) {
                
                $payment->payment_method_id = 1;
            }

            if($data['type_payment_method'] == 2) {
                $payment->payment_method_id = 2;
            }
            $payment->order_id = $order->id;
            $payment->paid = 1;
            $payment->save();
        }
        
        return $order;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
