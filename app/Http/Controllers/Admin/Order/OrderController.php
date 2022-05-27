<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Order\ChangeOrderStatusRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Responses\PaginationResponse;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use Lib;

    protected $OrderService;

    /**
     * @param OrderService $OrderService
     * @return void
     */
    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }
    public function index(Request $request)
    {
        return view('Admin.Order.index', $this->getList($request));
    }

    public function getList(Request $request)
    {
        $limit = $request->input('limit', config('pagination.limit'));
        $page = $request->input('page', config('pagination.start_page'));
        $filter = $request->input('filter',[]);
        $filter = is_array($filter) ? $filter : (array)json_decode($filter);
        $filter['status'] = $filter['status'] ?? config('common.status.active');
        $sortKey = !empty($filter['sort_key']) ? $filter['sort_key'] : config('pagination.sort_default.key');
        $sortValue = $filter['sort_value'] ?? config('pagination.sort_default.value');
        $order = $this->OrderService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => OrderResource::collection($order->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($order),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Order.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $order = $this->OrderService->findOrder($id);
            return $this->responseOK($order);
        }
        return $this->responseOK();
    }

    public function create(CreateOrderRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $order = $this->OrderService->createOrder($request->all());
                if ($order) {
                    return $this->responseOK($order);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeOrderStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $order = $this->OrderService->changeStatus($request->id, $request->boolean('status'));
                if ($order) {
                    return $this->responseOK($order);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
