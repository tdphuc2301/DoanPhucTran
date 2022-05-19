<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Traits\Lib;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ChangeProductStatusRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Responses\PaginationResponse;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
    use Lib;

    protected $productService;
    protected $categoryService;

    /**
     * @param ProductService $productService
     * @return void
     */
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }
    public function index(Request $request)
    {
        return view('Admin.Product.index', $this->getList($request));
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
        $products = $this->productService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $categories = $this->categoryService->getAllCategories();
        $result = [
            'list' => ProductResource::collection($products->items())->toArray($request),
            'categories' => CategoryResource::collection($categories)->toArray($request),
            'pagination' => PaginationResponse::getPagination($products),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Product.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $product = $this->productService->findProduct($id);
            return $this->responseOK($product);
        }
        return $this->responseOK();
    }

    public function create(CreateProductRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $product = $this->productService->createProduct($request->all());
                if ($product) {
                    return $this->responseOK($product);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeProductStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $product = $this->productService->changeStatus($request->id, $request->boolean('status'));
                if ($product) {
                    return $this->responseOK($product);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}

