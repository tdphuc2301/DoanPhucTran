<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Lib;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\RamResource;
use App\Http\Resources\RomResource;
use App\Http\Resources\WebResource;
use App\Http\Responses\PaginationResponse;
use App\Models\Alias;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Report;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\OrderService;
use App\Services\RamService;
use App\Services\RomService;
use App\Services\WebService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Nette\Utils\DateTime;


class WebController extends Controller
{
    use Lib;

    protected $webService;
    protected $categoryService;
    protected $romService;
    protected $ramService;
    protected $brandService;
    protected $customerRepository;
    protected $orderRepository;
    protected $orderDetailRepository;
    protected $paymentRepository;
    protected $orderService;
    const FREESHIP = 40000;

    /**
     * @param WebService $webService
     * @return void
     */
    public function __construct(
        WebService            $webService,
        CategoryService       $categoryService,
        RomService            $romService,
        RamService            $ramService,
        CustomerRepository    $customerRepository,
        OrderRepository       $orderRepository,
        OrderDetailRepository $orderDetailRepository,
        PaymentRepository     $paymentRepository,
        OrderService          $orderService,
        BrandService          $brandService)
    {
        $this->webService = $webService;
        $this->categoryService = $categoryService;
        $this->romService = $romService;
        $this->ramService = $ramService;
        $this->brandService = $brandService;
        $this->customerRepository = $customerRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->paymentRepository = $paymentRepository;
        $this->orderService = $orderService;
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
            'isDetail' => false,
            'isDashboard' => true
        ];


        if ($request->wantsJson()) {
            return $this->responseOK(view('web.Pages.dashboard.datatable', $result)->render(), 'Thành công', 200, count($listPhone));
        }

        return $result;

    }

    public function brandPhone(Request $request,$brand)
    {
        $brand_id = Alias::where('alias', $brand)->first(['model_id'])['model_id'];;
        $getBrand = Brand::where('id', $brand_id)->first();
        $limit = $request->input('limit', config('pagination.limit'));
        $page = $request->input('page', config('pagination.start_page'));
        $filter = $request->input('filter', []);
        $filter = is_array($filter) ? $filter : (array)json_decode($filter);
        $filter['status'] = $filter['status'] ?? config('common.status.active');
        $filter['brand_id'] = $brand_id;
        $sortKey = !empty($filter['sort_key']) ? $filter['sort_key'] : config('pagination.sort_default.key');
        $sortValue = $filter['sort_value'] ?? config('pagination.sort_default.value');
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
            'isDetail' => false,
            'isDashboard' => true,
            'getBrand' => $getBrand
        ];


        if ($request->wantsJson()) {
            return $this->responseOK(view('web.Pages.dashboard.datatable', $result)->render(), 'Thành công', 200, count($listPhone));
        }

        return view('web.Pages.brand.index', $result);
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
    
    

    public function detailProduct(Request $request, $brand, $alias)
    {
        $idProduct = Alias::where('alias', $alias)->first(['model_id'])['model_id'];
        $product = Product::where('id', $idProduct)->with(['rom', 'ram', 'brand', 'images', 'category', 'metaseo', 'colors'])->first();

        // Set number format money
        $product['price'] = number_format($product['price']);
        $product['sale_off_price'] = number_format($product['sale_off_price']);

        $listOtherProduct = Product::where('id', '!=', $idProduct)->where('brand_id', $product['brand_id'])
            ->with(['rom', 'ram', 'brand', 'images', 'category', 'alias'])->take(5)->get();;

        return view('web.Pages.detail.index', [
            'product' => $product,
            'promotions' => Promotion::all(),
            'listOtherProduct' => WebResource::collection($listOtherProduct)->toArray($request),
            'isDetail' => true,
            'isDashboard' => false
        ]);
    }


    public function getCart(Request $request)
    {
        if(!$request->has('product_id')) {
            return redirect()->route('dashboard');
        }
        $quantity = 1;
        $productCart = $request->session()->get('productCart');
        $dateCreatedOrder = new DateTime("now");
        $dateCreatedOrder->modify('+4 hour');
        $dateCreatedOrder->format('Y-m-d H:i:s');

        // 8h
        $closeTimeBranch =  new DateTime("tomorrow");
        $closeTimeBranch->modify('-4 hour');
        $closeTimeBranch->format('Y-m-d H:i:s');

        // 8h
        $eightHoursTomorrow =  new DateTime("tomorrow");
        $eightHoursTomorrow->modify('+8 hour');
        $eightHoursTomorrow->format('Y-m-d  H:i:s');

        if($dateCreatedOrder  >  $closeTimeBranch &&   $dateCreatedOrder  <  $eightHoursTomorrow) {
            $datetime = new DateTime('tomorrow');
            $datetime->modify('+8 hour');
            $datetime->format('Y-m-d  H:i:s');
            $create_at = $datetime;
        } else {
            $create_at = new DateTime("now");
        }

        $request->session()->put('expressOrder', $create_at);
        $orderTimeExpressClone = clone $request->session()->get('expressOrder');
        if (!$productCart) {
            $quantity = $request->session()->get('quantity') ?? $quantity;
            $productCart = Product::where('id', $request->product_id)->with(['images'])->get();
            $productCart = WebResource::collection($productCart)->toArray($request)[0];
            $productCart['express_order'] = $orderTimeExpressClone->modify('+4 hour')->format('H:i d/m/Y ');
            $request->session()->put('productCart', $productCart);
            $request->session()->put('colorName', $request->color_id);
        }

        if ( $request->quantity != $request->session()->get('quantity')) {
            $request->session()->put('quantity', $quantity);
        }

        $productCart['sale_off_price'] = str_replace(',', '.', $productCart['sale_off_price']);
        
        $shipment = str_replace(',', '.', number_format(WebController::FREESHIP));
        return view('web.Pages.cart-product', [
            'product' => $productCart,
            'quantity' => $quantity,
            'color_name' => $request->color_id,
            'shipment' => $shipment,
            'promotions' => Promotion::all(),
            'isDetail' => false,
            'isDashboard' => false
        ]);
    }

    public function postCart(Request $request)
    {
        
        
        if ($request->quantity_checkout != $request->session()->get('quantity')) {
            $request->session()->put('quantity', $request->quantity_checkout);
        }

        if ($request->total_price_checkout != $request->session()->get('total_price')) {
            $request->session()->put('total_price', $request->total_price_checkout);

        }

        if ($request->price_promotion_checkout != $request->session()->get('price_promotion')) {
            $request->session()->put('price_promotion', $request->price_promotion_checkout);
        }
        
        $request->session()->put('note', $request->note);
        $request->session()->put('promotion_id', $request->promotion_id);
        return redirect()->route('web.checkout.get');
    }

    public function getCheckout(Request $request)
    {
        if(!$request->session()->get('productCart')) {
            return redirect()->route('dashboard');
        }
        
        $customer = null;
        if (Auth::check()) {
            $customer = Customer::where('user_id', Auth::user()->id)->first();
        }

        return view('web.Pages.checkout-product', [
            'product' => $request->session()->get('productCart'),
            'total_price_checkout' => $request->session()->get('total_price'),
            'quantity' => number_format($request->session()->get('quantity')),
            'price_promotion_checkout' => number_format($request->session()->get('price_promotion')),
            'isDetail' => false,
            'isDashboard' => false,
            'customer' => $customer,
            'shipment' => number_format(WebController::FREESHIP)
        ]);
    }

    public function getBranchClosetCustomer($point1)
    {
        // TO DO
        $list_branch_value_km = [];

        $listBranch = Branch::all();
        foreach ($listBranch as $value) {
            $point2 = [
                $value->long,
                $value->lat,

            ];
            $canKm = $this->getDistanceBetweenTwoPoints($point1, $point2);
            $list_branch_value_km[$value->id] = $canKm;
        }

        asort($list_branch_value_km);
        
        return array_keys($list_branch_value_km);
    }

    public function postCheckout(Request $request)
    {

        $point1 = [
            $request->longitude,
            $request->latitude
        ];

        $product_id = $request->session()->get('productCart')['id'];


        // Get list branch closet customer
        $list_brach_id_closet_customer = $this->getBranchClosetCustomer($point1);
        $branch_closet_customer = null;
        foreach ($list_brach_id_closet_customer as $branch_id) {
            $product = Product::where([
                'branch_id' => $branch_id,
                'search' => $request->session()->get('productCart')['id']
            ])->first();
            if ($product) {
                $request->session()->put('productCart', $product);
                $product_id = $product['id'];
                $branch_closet_customer = $branch_id;
                break;
            }
        }

        // Save branch_id
        if (Auth::check()) {
            $user = Auth::user();
            $user_customer = User::find($user->id);
            $user_customer->branch_id = $branch_closet_customer;
            $user_customer->save();
            $customer = Customer::where('user_id', $user_customer->id)->first();
        } else {

            // create customer
            $customer = $this->customerRepository->save([
                'name' => $request->name,
                'address' => $request->search_address,
                'long' => $request->longitude,
                'lat' => $request->latitude,
                'email' => $request->email,
                'phone' => $request->phone,
                'point' => 10,
                'type_id' => 4,
                'user_id' => null,
                'index' => 0,
                'status' => 1
            ]);
        }
        
        // Save order
        $order = $this->orderRepository->save([
            'customer_id' => $customer->id,
            'promotion_id' => $request->session()->get('promotion_id'),
            'code' => $this->generateRandomString(),
            'note' => $request->session()->get('note'),
            'total_price' => $request->session()->get('total_price'),
            'branch_id' => $request->session()->get('productCart')['branch_id'],
            'index' => 1,
            'status' => 1,
            'price_promotion' => $request->session()->get('price_promotion'),
            'status_delivered' => 1,
            'created_at' => $request->session()->get('expressOrder'),
            'updated_at' => $request->session()->get('expressOrder'),
            
        ]);
        $price = str_replace(',', '', $request->session()->get('productCart')['sale_off_price']);

        // Save order detail
        $order_detail = $this->orderDetailRepository->save([
            'product_id' => $product_id,
            'order_id' => $order->id,
            'quantity' => $request->session()->get('quantity'),
            'price' => (integer)$price,
            'color_name' => $request->session()->get('colorName'),
        ]);

        // Save payment
        if ($request->paymentMethod === 'COD') {
            $paid = 1;
        } else if ($request->paymentMethod === 'paypal') {
            $paid = 3;
            $product = Product::find($product_id);
            $product->stock_quantity = $product->stock_quantity - $request->session()->get('quantity');
            $product->save();
        }
        $payment_order = $this->paymentRepository->save([
            'payment_code' => $this->generateRandomString(),
            'order_id' => $order->id,
            'paid' => $paid,
        ]);

        $shipment = number_format(WebController::FREESHIP);
        
        $now = new DateTime('now');
        $now->format('Y-m-d');
        $report = Report::where('branch_id',$request->session()->get('productCart')['branch_id'])->whereDate('date_created',$now)->first();
        if($report === null) {
            $report = new Report();
            $report->total_price = $request->session()->get('total_price');
            $report->total_order = 1;
            $report->date_created = $now;
            $report->branch_id = $request->session()->get('productCart')['branch_id'];
            $report->total_promotion = $request->session()->get('price_promotion');
            $report->save();
        } else {
            $report->total_price += $request->session()->get('total_price');
            $report->total_order += 1;
            $report->total_promotion += $request->session()->get('price_promotion');
            $report->save();
        }
        
        $express_order =$request->session()->get('expressOrder')->modify('+4 hour')->format('H:i d/m/Y');
        $quantity = $request->session()->get('quantity');
        $price_promotion = number_format($request->session()->get('price_promotion'));
        $total_price = number_format($request->session()->get('total_price'));

        $request->session()->flush();
        
        return view('web.Pages.success_product', [
            'order_code' => $order->code,
            'price' => number_format($price),
            'shipment' => $shipment,
            'quantity' => $quantity,
            'price_promotion' => $price_promotion,
            'total_price' => $total_price,
            'address' => $request->search_address,
            'express_order' => $express_order,
            'isDetail' => false,
            'isDashboard' => true
        ]);
        
    }

    public function shipper_product()
    {
        $user = Auth::user();
        $now = new DateTime('now');
        $now->format('Y-m-d');
        $orders = Order::where('branch_id', $user->branch_id)->whereDate('created_at',$now)->with(['customers', 'promotions', 'orderDetails', 'paids'])->get();
        foreach ($orders as $order) {
            $product = Product::where('id', $order['orderDetails'][0]['product_id'])->with('images')->get();
            $order['orderDetails'][0]['name'] = $product[0]->name;
            $order['orderDetails'][0]['price'] = number_format($product[0]->price);
            $order['orderDetails'][0]['sale_off_price'] = number_format($product[0]->sale_off_price);
            $order['orderDetails'][0]['images'] = $product[0]['images'][0]['path'];
        }
        return view('web.Pages.shipper.index', [
            'orders' => $orders,
            'shipment' => number_format(WebController::FREESHIP),
            'isDetail' => false,
            'isDashboard' => false
        ]);
    }

    public function updateOrderPaid(Request $request)
    {
        $order = Order::where('code', $request->code_order)->first();
        $order->status_delivered = 3;
        $order->save();
        $user = Auth::user();
        $now = new DateTime('now');
        $now->format('Y-m-d');
        $orders = Order::where('branch_id', $user->branch_id)->whereDate('created_at',$now)->with(['customers', 'promotions', 'orderDetails', 'paids'])->get();
        foreach ($orders as $order) {
            $product = Product::where('id', $order['orderDetails'][0]['product_id'])->with('images')->get();
            $order['orderDetails'][0]['name'] = $product[0]->name;
            $order['orderDetails'][0]['price'] = number_format($product[0]->price);
            $order['orderDetails'][0]['sale_off_price'] = number_format($product[0]->sale_off_price);
            $order['orderDetails'][0]['images'] = $product[0]['images'][0]['path'];
        }
        if ($request->wantsJson()) {
            return $this->responseOK(view('web.Pages.shipper.datatable', ['orders'=>$orders])->render(), 'Thành công', 200, count($orders));
        }
        return $orders;
    }

    public function getLogin(Request $request)
    {
        $request->session()->put('url_back', url()->previous());

        return view('web.Pages.login');
    }

    public function postLogin(Request $request)
    {
        $this->validateLogin($request);
        $credentials = request(['username', 'password']);
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return redirect(route('login_web_get'))->with("message", "Username is wrong!");
        } else {
            if (!Hash::check($request->password, $user->password, [])) {
                return redirect(route('login_web_get'))->with('message', 'Passwword is wrong!');
            } else {
                $roles = $user->role;
                if ($roles->name === User::CUSTOMER) {
                    Auth::attempt($credentials);
                    return redirect($request->session()->get('url_back'));
                } else if ($roles->name === User::SHIPPER) {
                    return redirect(route('order_for_shipper'));
                }
            }
        }

        return redirect(route('login_web_get'));
    }


    public function getRegister(Request $request)
    {

        return view('web.Pages.register');
    }

    public function postRegister(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->role_id = 4;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->status = 1;
        $user->save();

        $customer = $this->customerRepository->save([
            'name' => $request->name,
            'address' => $request->search_address,
            'long' => $request->longitude,
            'lat' => $request->latitude,
            'email' => $request->email,
            'phone' => $request->phone,
            'point' => 10,
            'type_id' => 4,
            'user_id' => $user->id,
            'index' => 0,
            'status' => 1
        ]);


        $credentials = request(['username', 'password']);
        Auth::attempt($credentials);

        return redirect(route('dashboard'));
    }

    public function getLogout()
    {
        Auth::logout();
        return back();
    }

    public function getLoginShipper(Request $request)
    {

        return view('web.Pages.shipper.login', [
            'isDetail' => false,
            'isDashboard' => true
        ]);
    }

    public function postLoginShipper(Request $request)
    {
        $this->validateLogin($request);
        $credentials = request(['username', 'password']);
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return redirect(route('login_shipper_get'))->with("message", "Username bị sai!");
        } else {
            if (!Hash::check($request->password, $user->password, [])) {
                return redirect(route('login_shipper_get'))->with('message', 'Mật khẩu bị sai!');
            } else {
                $roles = $user->role;
                if ($roles->name === User::SHIPPER) {
                    Auth::attempt($credentials);
                    return redirect(route('order_for_shipper'));
                } else if ($roles->name === User::CUSTOMER) {
                    return redirect(route('login_shipper_get'))->with('message', 'Bạn không có quyền!');
                }
            }
        }

        return redirect(route('login_web_get'));
    }
    
    public function searchOrder()
    {
        return view('web.Pages.history_search-order', [
            'isDetail' => false,
            'isDashboard' => true
        ]);
    }

    public function historyOrder(Request $request)
    {
        if (Auth::check() && Auth::user()->role_id === 4) {
            $user = Auth::user();
            $customer = Customer::where('user_id', $user->id)->first();
            $this->checkExpressOrder($customer['id']);
            $orders = Order::where([
                'status' => 1,
                'customer_id' => $customer['id'],
            ])->with(['customers', 'promotions', 'orderDetails', 'paids'])->get();
            foreach ($orders as $order) {
                $product = Product::where('id', $order['orderDetails'][0]['product_id'])->with('images')->get();
                $order['orderDetails'][0]['name'] = $product[0]->name;
                $order['orderDetails'][0]['price'] = $product[0]->price;
                $order['orderDetails'][0]['sale_off_price'] = $product[0]->sale_off_price;
                $order['orderDetails'][0]['images'] = $product[0]['images'][0]['path'];
                $order['paids'][0]['message'] = $this->convertMessage($order['paids'][0]['paid']);
                $order['paids'][0]['showClass'] = $this->convertToShowClass($order['paids'][0]['paid']);
                $order['messageDelivery'] = $this->convertMessageDelivery($order['status_delivered']);
                $order['showClassDelivery']= $this->convertToShowClassDeliverry($order['status_delivered']);
            }
            return view('web.Pages.history-order', [
                'orders' => $orders,
                'isDetail' => false,
                'isDashboard' => true
            ]);
        } else {
            return view('web.Pages.history.index',
                [
                    'isDetail' => false,
                    'isDashboard' => true,
                    'list' => []
                ]);
        }
    }

    public function searchHistoryOrderByPhone(Request $request)
    {
            $customer = Customer::where('phone', $request['phone'])->first();
            $this->checkExpressOrder($customer['id']);
            $orders = Order::where([
                'status' => 1,
                'customer_id' => $customer['id'],
            ])->with(['customers', 'promotions', 'orderDetails', 'paids'])->get();
            foreach ($orders as $order) {
                $product = Product::where('id', $order['orderDetails'][0]['product_id'])->with('images')->get();
                $order['orderDetails'][0]['name'] = $product[0]->name;
                $order['orderDetails'][0]['price'] = $product[0]->price;
                $order['orderDetails'][0]['sale_off_price'] = $product[0]->sale_off_price;
                $order['orderDetails'][0]['images'] = $product[0]['images'][0]['path'];
                $order['paids'][0]['message'] = $this->convertMessage($order['paids'][0]['paid']);
                $order['paids'][0]['showClass'] = $this->convertToShowClass($order['paids'][0]['paid']);
                $order['messageDelivery'] = $this->convertMessageDelivery($order['status_delivered']);
                $order['showClassDelivery']= $this->convertToShowClassDeliverry($order['status_delivered']);
            }
        if ($request->wantsJson()) {
            return $this->responseOK(view('web.Pages.history.datatable', ['orders' => $orders] )->render(), 'Thành công', 200, count($orders));
        }
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

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function validateLogin($request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    }

    public function convertMessage(int $paid)
    {
        switch ($paid) {
            case 1:
                return 'Chưa thanh toán';
            case 2:
                return 'Thanh toán thất bại';
            case 3:
                return 'Đã thanh toán';
            case 4:
                return 'Hủy đơn hàng';
            default:
                return '';
        }
    }

    function convertToShowClass(int $paid): string
    {
        switch ($paid) {
            case 1:
                return 'label-info';
            case 2:
                return 'label-warning';
            case 3:
                return 'label-success';
            case 4:
                return 'label-danger';
            default:
                return '';


        }
    }

    public function convertMessageDelivery(int $paid): string
    {
        switch ($paid) {
            case 1:
                return 'Chuẩn bị hàng';
            case 2:
                return 'Đang giao hàng';
            case 3:
                return 'Đã nhận hàng';
            case 4:
                return 'Giao hàng thất bại';
            case 5:
                return 'Hủy đơn hàng';
            default:
                return 'Giao hàng thất bại';
        }
    }

    function convertToShowClassDeliverry(int $paid): string
    {
        switch ($paid) {
            case 1:
                return 'label-info';
            case 2:
                return 'label-warning';
            case 3:
                return 'label-success';
            case 4:
                return 'label-danger';
            case 5:
                return 'label-danger';
            default:
                return 'label-danger';


        }
    }
    
    function checkExpressOrder($customer_id): string
    {
        $listOrderCustomer = Order::where('customer_id', $customer_id)->get();
        foreach($listOrderCustomer as $order) {
            $dateOrder = new DateTime($order->created_at);
            $dateOrder->modify('+4 hour');

            $now = new DateTime("now");
            if($dateOrder < $now) {
                $paid = $order->paids;
                if($paid[0]->paid == 1 ) {
                    $payment = Payment::find($paid[0]->id);
                    $payment->paid = 4;
                    $payment->save();
                }
            }
            
        }
        return true;
    }
    
}