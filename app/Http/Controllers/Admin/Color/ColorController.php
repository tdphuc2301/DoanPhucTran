<?php

namespace App\Http\Controllers\Admin\Color;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Color\ChangeColorStatusRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Resources\ColorResource;
use App\Http\Responses\PaginationResponse;
use App\Services\ColorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    use Lib;

    protected $colorService;

    /**
     * @param ColorService $colorService
     * @return void
     */
    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }
    public function index(Request $request)
    {
        return view('Admin.Color.index', $this->getList($request));
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
        $categories = $this->colorService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => ColorResource::collection($categories->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($categories),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Color.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $color = $this->colorService->findColor($id);
            return $this->responseOK($color);
        }
        return $this->responseOK();
    }

    public function create(CreateColorRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $color = $this->colorService->createColor($request->all());
                if ($color) {
                    return $this->responseOK($color);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeColorStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $color = $this->colorService->changeStatus($request->id, $request->boolean('status'));
                if ($color) {
                    return $this->responseOK($color);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
