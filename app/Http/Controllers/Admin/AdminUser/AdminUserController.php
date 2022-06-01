<?php

namespace App\Http\Controllers\Admin\AdminUser;

use App\Http\Controllers\Traits\Lib;
use App\Http\Requests\AdminUser\ChangeAdminUserStatusRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUser\CreateAdminUserRequest;
use App\Http\Resources\AdminUserResource;
use App\Http\Responses\PaginationResponse;
use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use App\Services\AdminUserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    use Lib;

    protected $adminUserService;

    /**
     * @param AdminUserService $adminUserService
     * @return void
     */
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }
    public function index(Request $request)
    {
        return view('Admin.AdminUser.index', $this->getList($request));
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
        $adminUser = $this->adminUserService->paginateAll($page, $limit, $filter, $sortKey, $sortValue);
        $roles = Role::all();
        $listRole = [];
        foreach ($roles as $role) {
            if($role->name === User::ADMIN || $role->name === User::SHIPPER) {
                $listRole[] = $role;
            }
        }
        $result = [
            'list' => AdminUserResource::collection($adminUser->items())->toArray($request),
            'pagination' => PaginationResponse::getPagination($adminUser),
            'sort_key' => $sortKey,
            'sort_value' => $sortValue,
            'branchs' => Branch::all(),
            'role' => $listRole
        ];
        if ($request->wantsJson()) {
            return $this->responseOK(view('Admin.AdminUser.datatable', $result)->render());
        }
        return $result;
    }

    public function getById($id = null, Request $request)
    {
        if($id){
            $adminUser = $this->adminUserService->findAdminUser($id);
            return $this->responseOK($adminUser);
        }
        return $this->responseOK();
    }

    public function create(CreateAdminUserRequest $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $adminUser = $this->adminUserService->createAdminUser($request->all());
                if ($adminUser) {
                    return $this->responseOK($adminUser);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }

    public function changeStatus(ChangeAdminUserStatusRequest $request){
        try {
            return DB::transaction(function () use ($request) {
                $adminUser = $this->adminUserService->changeStatus($request->id, $request->boolean('status'));
                if ($adminUser) {
                    return $this->responseOK($adminUser);
                }
                return $this->responseError(Response::HTTP_BAD_REQUEST);
            });
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }
    }
}
