<?php

use App\Http\Controllers\Api\Upload\UploadImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api'], function (){
    Route::group(['namespace'=>'Delivery','prefix'=>'delivery'], function (){
        Route::get('map-province', 'DeliveryController@mapProvinceJT');
    });
    Route::group(['namespace'=>'Address','prefix'=>'address'], function (){
        Route::get('get-province', 'AddressController@getProvince')->name('api.address.get_province');
        Route::get('get-district', 'AddressController@getDistrict')->name('api.address.get_district');
        Route::get('get-ward', 'AddressController@getWard')->name('api.address.get_ward');
    });
    Route::group(['namespace'=>'Upload','prefix'=>'upload'], function (){
        Route::post('upload-image', [UploadImageController::class,'uploadImage']);
        Route::post('upload-image-ckeditor', [UploadImageController::class,'uploadImageCkeditor'])->name('api.upload.ckeditor');
    });
});
