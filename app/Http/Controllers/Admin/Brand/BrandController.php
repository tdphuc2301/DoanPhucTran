<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Brand\ChangeBrandStatusRequest;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Responses\PaginationResponse;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    use Lib;

    protected $brandService;

    /**
     * @param BrandService $brandService
     * @return void
     */
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    public function index(Request $request)
    {
        return view('Admin.Brand.index', $this->getList($request));
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
        $brand = $this->brandService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => BrandResource::collection($brand->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($brand),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Brand.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
           $brand = $this->brandService->findBrand($id);
            return $this->responseOK($brand);
        }
        return $this->responseOK();
    }

    public function create(CreateBrandRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $brand = $this->brandService->createBrand($request->all());
                if ($brand) {
                    return $this->responseOK($brand);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeBrandStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $brand = $this->brandService->changeStatus($request->id, $request->boolean('status'));
                if ($brand) {
                    return $this->responseOK($brand);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
