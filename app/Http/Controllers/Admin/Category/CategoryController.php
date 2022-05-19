<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\ChangeCategoryStatusRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Responses\PaginationResponse;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use Lib;

    protected $categoryService;

    /**
     * @param CategoryService $categoryService
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        return view('Admin.Category.index', $this->getList($request));
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
        $categories = $this->categoryService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => CategoryResource::collection($categories->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($categories),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Category.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $category = $this->categoryService->findCategory($id);
            return $this->responseOK($category);
        }
        return $this->responseOK();
    }

    public function create(CreateCategoryRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $category = $this->categoryService->createCategory($request->all());
                if ($category) {
                    return $this->responseOK($category);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeCategoryStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $category = $this->categoryService->changeStatus($request->id, $request->boolean('status'));
                if ($category) {
                    return $this->responseOK($category);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
