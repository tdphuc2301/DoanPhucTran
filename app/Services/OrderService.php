<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\order;
use App\Models\Order_detail;
use App\Models\Payment;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    private $orderRepository;
    private $orderDetailRepository;
    private $paymentRepository;
    /**
     * @param OrderRepository $orderRepository
     * @param OrderDetailRepository $orderDetailRepository
     * @param PaymentRepository $paymentRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        OrderDetailRepository $orderDetailRepository,
        PaymentRepository $paymentRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->paymentRepository = $paymentRepository;
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
            $filter['code'] = [
                'operator' => 'LIKE',
                'value' => "%". $data['keyword']. "%"
            ];
        }
        $user_branch_id = Auth::user()->branch_id;
        if(isset($user_branch_id)) {
            $filter['branch_id'] = $user_branch_id;
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
    public function getAllOrder(?int $status=null): ?Collection{
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
    public function findOrder(int $id): ?Model
    {
        return $this->orderRepository->findOne($id, ['customers','promotions','orderDetails','paids']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createOrder(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $order = $this->orderRepository->findOne($data['id']);
            $order = $this->orderRepository->update($order, $data);
            
            $order_detail = Order_detail::where('order_id', $data['id'])->first();
            $order_detail->quantity = $data['quantity'];
            $order_detail->save();

            $payment_order = Payment::where('order_id', $data['id'])->first();
            $payment_order->paid = $data['paid'];
            $payment_order->save();
            
        } else {
            
            // Save order
            $order = $this->orderRepository->save([
                'customer_id' => $data['customer_id'],
                'promotion_id' => $data['promotion_id'],
                'code' => $data['code'],
                'note' => $data['note'],
                'total_price' => $data['total_price'],
                'branch_id' => $data['branch_id'],
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);

            // Save order detail
            $order_detail = $this->orderDetailRepository->save([
            'product_id' => $data['product_id'],
            'order_id' => $order->id,
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            ]);
            
            // Save payment
            $payment_order = $this->paymentRepository->save([
                'payment_code' => $this->generateRandomString(),
                'order_id' => $order->id,
                'payment_method_id' => (int)$data['type_payment_method'],
                'paid' => $data['paid'],
            ]);
            
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
