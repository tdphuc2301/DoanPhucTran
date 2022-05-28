<?php

namespace App\Http\Controllers\Admin\Promotion;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\Promotion\ChangePromotionStatusRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Promotion\CreatePromotionRequest;
use App\Http\Resources\PromotionResource;
use App\Http\Responses\PaginationResponse;
use App\Models\TypePromotion;
use App\Services\PromotionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    use Lib;

    protected $promotionService;

    /**
     * @param PromotionService $promotionService
     * @return void
     */
    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }
    public function index(Request $request)
    {
        return view('Admin.Promotion.index', $this->getList($request));
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
        $promotion = $this->promotionService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => PromotionResource::collection($promotion->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($promotion),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
            'type_promotions'=> TypePromotion::all()
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Promotion.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $promotion = $this->promotionService->findPromotion($id);
            return $this->responseOK($promotion);
        }
        return $this->responseOK();
    }

    public function create(CreatePromotionRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $promotion = $this->promotionService->createPromotion($request->all());
                if ($promotion) {
                    return $this->responseOK($promotion);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangePromotionStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $promotion = $this->promotionService->changeStatus($request->id, $request->boolean('status'));
                if ($promotion) {
                    return $this->responseOK($promotion);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
