<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Customer\ChangeCustomerStatusRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Responses\PaginationResponse;
use App\Models\TypeCustomer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    use Lib;

    protected $customerService;

    /**
     * @param CustomerService $customerService
     * @return void
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    public function index(Request $request)
    {
        return view('Admin.Customer.index', $this->getList($request));
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
        $customer = $this->customerService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => CustomerResource::collection($customer->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($customer),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
            'type_customers' => TypeCustomer::all(),
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Customer.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $customer = $this->customerService->findCustomer($id);
            $customer['isEditPassword'] = false;
            return $this->responseOK($customer);
        }
        return $this->responseOK();
    }

    public function create(CreateCustomerRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $customer = $this->customerService->createCustomer($request->all());
                if ($customer) {
                    return $this->responseOK($customer);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeCustomerStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $customer = $this->customerService->changeStatus($request->id, $request->boolean('status'));
                if ($customer) {
                    return $this->responseOK($customer);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
