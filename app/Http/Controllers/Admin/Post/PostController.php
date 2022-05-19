<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Traits\Lib;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\ChangePostStatusRequest;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Responses\PaginationResponse;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use Lib;

    protected $postService;

    /**
     * @param PostService $postService
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index(Request $request)
    {
        return view('Admin.Post.index', $this->getList($request));
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
        $posts = $this->postService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $result = [
            'list' => PostResource::collection($posts->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($posts),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.Post.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $post = $this->postService->findPost($id);
            return $this->responseOK($post);
        }
        return $this->responseOK();
    }

    public function create(CreatePostRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $post = $this->postService->createPost($request->all());
                if ($post) {
                    return $this->responseOK($post);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangePostStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $post = $this->postService->changeStatus($request->id, $request->boolean('status'));
                if ($post) {
                    return $this->responseOK($post);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}

