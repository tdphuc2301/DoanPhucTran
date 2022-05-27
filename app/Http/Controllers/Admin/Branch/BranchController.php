<?php

namespace App\Http\Controllers\Admin\Branch;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Branch\ChangeBranchStatusRequest;
use App\Http\Requests\Branch\CreateBranchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Http\Responses\PaginationResponse;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Services\BranchService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    use Lib;

    protected $branchService;

    /**
     * @param BranchService $branchService
     * @return void
     */
    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }
    public function index(Request $request)
    {
        return view('Admin.Branch.index', $this->getList($request));
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
        $branch = $this->branchService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => BranchResource::collection($branch->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($branch),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Branch.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $branch = $this->branchService->findBranch($id);
            return $this->responseOK($branch);
        }
        return $this->responseOK();
    }

    public function create(CreateBranchRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $branch = $this->branchService->createBranch($request->all());
                if ($branch) {
                    return $this->responseOK($branch);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeBranchStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $branch = $this->branchService->changeStatus($request->id, $request->boolean('status'));
                if ($branch) {
                    return $this->responseOK($branch);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
