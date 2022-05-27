<?php

namespace App\Http\Controllers\Admin\PaymentMethod;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\PaymentMethod\ChangePaymentMethodStatusRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethod\CreatePaymentMethodRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Responses\PaginationResponse;
use App\Services\PaymentMethodService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PaymentMethodController extends Controller
{
    use Lib;

    protected $paymentMethodService;

    /**
     * @param PaymentMethodService $paymentMethodService
     * @return void
     */
    public function __construct(PaymentMethodService $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }
    public function index(Request $request)
    {
        return view('Admin.PaymentMethod.index', $this->getList($request));
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
        $paymentMethod = $this->paymentMethodService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => PaymentMethodResource::collection($paymentMethod->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($paymentMethod),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.PaymentMethod.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $paymentMethod = $this->paymentMethodService->findPaymentMethod($id);
            return $this->responseOK($paymentMethod);
        }
        return $this->responseOK();
    }

    public function create(CreatePaymentMethodRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $paymentMethod = $this->paymentMethodService->createPaymentMethod($request->all());
                if ($paymentMethod) {
                    return $this->responseOK($paymentMethod);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangePaymentMethodStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $paymentMethod = $this->paymentMethodService->changeStatus($request->id, $request->boolean('status'));
                if ($paymentMethod) {
                    return $this->responseOK($paymentMethod);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
