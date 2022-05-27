<?php

namespace App\Http\Controllers\Admin\Ram;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Ram\ChangeRamStatusRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ram\CreateColorRequest;
use App\Http\Resources\RamResource;
use App\Http\Responses\PaginationResponse;
use App\Services\ramService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RamController extends Controller
{
    use Lib;

    protected $ramService;

    /**
     * @param ramService $ramService
     * @return void
     */
    public function __construct(ramService $ramService)
    {
        $this->ramService = $ramService;
    }
    public function index(Request $request)
    {
        return view('Admin.Ram.index', $this->getList($request));
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
        $categories = $this->ramService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => RamResource::collection($categories->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($categories),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Ram.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $ram = $this->ramService->findRam($id);
            return $this->responseOK($ram);
        }
        return $this->responseOK();
    }

    public function create(CreateColorRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $ram = $this->ramService->createRam($request->all());
                if ($ram) {
                    return $this->responseOK($ram);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeRamStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $ram = $this->ramService->changeStatus($request->id, $request->boolean('status'));
                if ($ram) {
                    return $this->responseOK($ram);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
