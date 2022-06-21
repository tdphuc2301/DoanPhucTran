<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Traits\Lib;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ChangeProductStatusRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Responses\PaginationResponse;
use App\Models\Product;
use App\Models\Product_branch;
use App\Services\BranchService;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ColorService;
use App\Services\ProductService;
use App\Services\RamService;
use App\Services\RomService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
    use Lib;

    protected $productService;
    protected $categoryService;
    protected $romService;
    protected $ramService;
    protected $colorService;
    protected $branchService;
    protected $brandService;


    /**
     * @param ProductService $productService
     * @return void
     */
    public function __construct(
        ProductService $productService, 
        CategoryService $categoryService,
        RomService $romService,
        RamService $ramService,
        ColorService $colorService,
        BranchService $branchService,
        BrandService $brandService

    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->romService = $romService;
        $this->ramService = $ramService;
        $this->colorService = $colorService;
        $this->branchService = $branchService;
        $this->brandService = $brandService;
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
        $roms= $this->romService->getAllRom();
        $rams= $this->ramService->getAllRam();
        $colors= $this->colorService->getAllColor();
        $branchs= $this->branchService->getAllBranch();
        $brands= $this->brandService->getAllBrand();
        $result = [
            'list' => ProductResource::collection($products->items())->toArray($request),
            'categories' => CategoryResource::collection($categories)->toArray($request),
            'roms' => CategoryResource::collection($roms)->toArray($request),
            'rams' => CategoryResource::collection($rams)->toArray($request),
            'colors' => CategoryResource::collection($colors)->toArray($request),
            'branchs' => CategoryResource::collection($branchs)->toArray($request),
            'brands' => CategoryResource::collection($brands)->toArray($request),
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

    public function info() {
        $branch = Auth::user()->branch_id;
        $list = DB::table('products')
                ->join('product_branchs', 'product_branchs.product_id', '=', 'products.id')
                ->select('products.id', 'products.name', 'products.price', 'products.sale_off_price', 'products.status', 'product_branchs.stock_quantity' )
                ->where('product_branchs.branch_id', $branch)->get();
        return view ('admin.Product.info')->with('list', $list);
    }
    public function addInfo() {
        $products = Product::all();
        return view ('admin.Product.addInfo')->with('products', $products);
    }
    public function createInfo(Request $request) {
        $product_branchs = Product_branch::where('product_id', $request->product_id)->where('branch_id', Auth::user()->branch_id)->first();
        if (isset($product_branchs)){
            $product_branchs->stock_quantity = (int)$product_branchs->stock_quantity + (int)$request->stock_quantity;
        } else {
            $pro = Product::find($request->product_id);
            $product_branchs = new Product_branch();
            $product_branchs->branch_id = Auth::user()->branch_id;
            $product_branchs->product_id = $pro->id;
            $product_branchs->stock_quantity = $request->stock_quantity;
        }
        $product_branchs->save();
        return redirect(route('admin.product.info'));
    }
    public function editInfo($id) {
        $branch = Auth::user()->branch_id;
        $products = Product::all();
        $list = DB::table('products')
                ->join('product_branchs', 'product_branchs.product_id', '=', 'products.id')
                ->select('products.id', 'products.name', 'products.price', 'products.sale_off_price', 'products.status', 'product_branchs.stock_quantity' )
                ->where('product_branchs.branch_id', $branch)
                ->where('product_branchs.product_id', $id)->first();
        if (isset($list)){
            return view ('admin.Product.editInfo')->with('list', $list)->with('products', $products);
        }
        return view ('admin.Product.info')->with('list', $list);
    }
    public function updateInfo($id, Request $request) {
        $product_branchs = Product_branch::where('product_id', $id)->where('branch_id', Auth::user()->branch_id)->first();
        if (isset($product_branchs)){
            $product_branchs->stock_quantity = (int)$request->stock_quantity;
            $product_branchs->save();
        }
        return redirect(route('admin.product.info'));
    }
}
