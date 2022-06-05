<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Lib;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RamResource;
use App\Http\Resources\RomResource;
use App\Http\Resources\WebResource;
use App\Http\Responses\PaginationResponse;
use App\Models\Alias;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Promotion;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\RamService;
use App\Services\RomService;
use App\Services\WebService;
use Illuminate\Http\Request;


class WebController extends Controller
{
    use Lib;

    protected $webService;
    protected $categoryService;
    protected $romService;
    protected $ramService;
    protected $brandService;

    /**
     * @param WebService $webService
     * @return void
     */
    public function __construct(
        WebService      $webService,
        CategoryService $categoryService,
        RomService      $romService,
        RamService      $ramService,
        BrandService    $brandService)
    {
        $this->webService = $webService;
        $this->categoryService = $categoryService;
        $this->romService = $romService;
        $this->ramService = $ramService;
        $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        return view('web.Pages.dashboard.index', $this->getList($request,));
    }

    public function getList(Request $request, $branch_id = '')
    {
        $limit = $request->input('limit', config('pagination.limit'));
        $page = $request->input('page', config('pagination.start_page'));
        $filter = $request->input('filter', []);
        $filter = is_array($filter) ? $filter : (array)json_decode($filter);
        $filter['status'] = $filter['status'] ?? config('common.status.active');
        $sortKey = !empty($filter['sort_key']) ? $filter['sort_key'] : config('pagination.sort_default.key');
        $sortValue = $filter['sort_value'] ?? config('pagination.sort_default.value');
        if ($branch_id !== '') {
            $filter['branch_id'] = $branch_id;
        }
        $categories = $this->categoryService->getAllCategories();
        $roms = $this->romService->getAllRom();
        $rams = $this->ramService->getAllRam();
        $brands = $this->brandService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $listPhone = $this->webService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $listPrice = [
            0 => [
                'prices' => '0-2',
                'name' => " Dưới 2t"
            ],
            1 => [
                'prices' => '2-5',
                'name' => " Từ 2t đến 5t"
            ],
            2 => [
                'prices' => '5-7',
                'name' => " Từ 5t đến 7t"
            ],
            3 => [
                'prices' => '7-13',
                'name' => " Từ 7t đến 13t"
            ],
            4 => [
                'prices' => '13-20',
                'name' => " Từ 13t đến 20t"
            ],
            5 => [
                'prices' => '20',
                'name' => " 20t trở lên"
            ],

        ];
        $result = [
            'list' => WebResource::collection($listPhone->items())->toArray($request),
            'categories' => CategoryResource::collection($categories)->toArray($request),
            'roms' => RomResource::collection($roms)->toArray($request),
            'rams' => RamResource::collection($rams)->toArray($request),
            'brands' => BrandResource::collection($brands->items())->toArray($request),
            'listPrice' => $listPrice,
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];


        if ($request->wantsJson()) {
            return $this->responseOK(view('web.Pages.dashboard.datatable', $result)->render(), 'Thành công', 200, count($listPhone));
        }

        return $result;

    }

    public function searchBranchClosestUser(Request $request)
    {
        // TO DO 
        $allowToResult = true;

        $listBranch = Branch::all();
        $point1 = [
            $request->long,
            $request->lat,

        ];
        $branchIdClosetUser = '';
        $kmCloset = 0;
        foreach ($listBranch as $key => $value) {
            $point2 = [
                $value->long,
                $value->lat,

            ];
            $canKm = $this->getDistanceBetweenTwoPoints($point1, $point2);
            if ($key == 0) {
                $branchIdClosetUser = $value->id;
                $kmCloset = $canKm;
            }
            if ($canKm < $kmCloset) {
                $branchIdClosetUser = $value->id;
                $kmCloset = $canKm;
            }
        }

        return $this->getList($request, $branchIdClosetUser);
    }

    public function searchFilterField(Request $request)
    {
        $filter = $request->input('filter', []);
        $filter = is_array($filter) ? $filter : (array)json_decode($filter);
        $filter['status'] = $filter['status'] ?? config('common.status.active');
        $sortKey = !empty($filter['sort_key']) ? $filter['sort_key'] : config('pagination.sort_default.key');
        $sortValue = $filter['sort_value'] ?? config('pagination.sort_default.value');
        $listPhone = Product::where('status', $filter['status']);

        if (!empty($filter['brand'])) {
            $listPhone->whereIn('brand_id', $filter['brand']);
        }
        if (!empty($filter['branch_id'])) {
            $listPhone->whereIn('brand_id', $filter['brand']);
        }
        if (!empty($filter['rom'])) {
            $listPhone->whereIn('rom_id', $filter['rom']);
        }
        if (!empty($filter['ram'])) {
            $listPhone->whereIn('ram_id', $filter['ram']);
        }
        if (!empty($filter['category'])) {
            $listPhone->whereIn('category_id', $filter['category']);
        }
        if (!empty($filter['price'])) {
            $price = explode('-', $filter['price'][0]);
            $min_price = $price[0];
            $max_price = $price[1];
            if ($max_price === '') {
                $listPhone->where('price', '>', $max_price);
            } else {
                $listPhone->whereBetween('price', [$min_price, $max_price]);
            }
        }

        $listPhone = $listPhone->with(['images', 'alias'])->get();

        $result = [
            'list' => WebResource::collection($listPhone)->toArray($request),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];


        if ($request->wantsJson()) {
            return $this->responseOK(view('web.Pages.dashboard.datatable', $result)->render(), 'Thành công', 200, count($listPhone));
        }
        return $result;
    }

    public function detailProduct(Request $request,$brand,$alias)
    {
        $idProduct = Alias::where('alias',$alias)->first(['model_id'])['model_id'];
        $product = Product::where('id',$idProduct)->with(['rom','ram','brand','images','category','metaseo','colors'])->first();
        setlocale(LC_MONETARY, 'en_IN');
        
        // Set number format money
        $product['price'] = number_format( $product['price']);
        $product['sale_off_price'] = number_format( $product['sale_off_price']);

        $listOtherProduct = Product::where('id','!=',$idProduct)->where('brand_id',$product['brand_id'])
            ->with(['rom','ram','brand','images','category','alias'])->take(5)->get();;

        return view('web.Pages.detail.index',[
            'product' => $product,
            'promotions'=>Promotion::all(), 
            'listOtherProduct'=> WebResource::collection($listOtherProduct)->toArray($request),
        ]);
    }
    

    public function cartProduct(Request $request)
    {
        $request = $request->all();
        
        return view('web.Pages.cart-product');
    }

    public function checkoutProduct()
    {
        return view('web.Pages.checkout-product');
    }

    public function successProduct()
    {
        return view('web.Pages.success_product');
    }

    public function shipper_product()
    {
        return view('web.Pages.shipper.index');
    }

    public function logout()
    {
        return 123;
    }

    public function report()
    {
        return 123;
    }


    public function getDistanceBetweenTwoPoints($point1, $point2)
    {
        // array of lat-long i.e  $point1 = [lat,long]
        $earthRadius = 6371;  // earth radius in km
        $point1Lat = $point1[0];
        $point2Lat = $point2[0];
        $deltaLat = deg2rad($point2Lat - $point1Lat);
        $point1Long = $point1[1];
        $point2Long = $point2[1];
        $deltaLong = deg2rad($point2Long - $point1Long);
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos(deg2rad($point1Lat)) * cos(deg2rad($point2Lat)) * sin($deltaLong / 2) * sin($deltaLong / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        return $distance;    // in km
    }

}