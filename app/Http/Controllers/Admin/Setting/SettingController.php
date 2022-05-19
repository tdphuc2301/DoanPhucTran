<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Traits\Lib;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    use Lib;

    protected $settingService;

    /**
     * @param SettingService $settingService
     * @return void
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }
    public function index()
    {
        $settings = $this->settingService->getSetting()->keyBy('key');
        $a = [];
        return view('Admin.Setting.index', [
            'settings' => $settings->toArray()
        ]);
    }


    // public function changeStatus(ChangeCategoryStatusRequest $request){
    //     try {
    //         return DB::transaction(function () use ($request) {
    //             $category = $this->categoryService->changeStatus($request->id, $request->boolean('status'));
    //             if ($category) {
    //                 return $this->responseOK($category);
    //             }
    //             return $this->responseError(Response::HTTP_BAD_REQUEST);
    //         });
    //     } catch (\Exception $e) {
    //         return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, $e);
    //     }
    // }
}
