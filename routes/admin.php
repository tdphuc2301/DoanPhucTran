<?php

use App\Http\Controllers\Api\Login\LoginController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Admin','middleware'=>'admin.check'], function (){
    Route::get('/', 'DashboardController@index')->name('admin.dashboard')->middleware('admin.manager.role');
    Route::get('/report', 'DashboardController@report')->name('admin.report');
    Route::get('/logout', 'DashboardController@logout')->name('admin.logout');
    Route::get('/change-password', 'DashboardController@logout')->name('admin.user.change_password');

    Route::group(['namespace' => 'Category', 'prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.index');
        Route::get('/get-list', 'CategoryController@getList')->name('admin.category.get_list');
        Route::get('/find/{id?}', 'CategoryController@getById')->name('admin.category.get_category');
        Route::post('/create', 'CategoryController@create')->name('admin.category.create');
        Route::put('/change-status', 'CategoryController@changeStatus')->name('admin.category.change_status');
    });

    // Brand
    Route::group(['namespace' => 'Brand', 'prefix' => 'brand'], function () {
        Route::get('/', 'BrandController@index')->name('admin.brand.index');
        Route::get('/get-list', 'BrandController@getList')->name('admin.brand.get_list');
        Route::get('/find/{id?}', 'BrandController@getById')->name('admin.brand.get_category');
        Route::post('/create', 'BrandController@create')->name('admin.brand.create');
        Route::put('/change-status', 'BrandController@changeStatus')->name('admin.brand.change_status');
    });

    // Ram
    Route::group(['namespace' => 'Ram', 'prefix' => 'ram'], function () {
        Route::get('/', 'RamController@index')->name('admin.ram.index');
        Route::get('/get-list', 'RamController@getList')->name('admin.ram.get_list');
        Route::get('/find/{id?}', 'RamController@getById')->name('admin.ram.get_category');
        Route::post('/create', 'RamController@create')->name('admin.ram.create');
        Route::put('/change-status', 'RamController@changeStatus')->name('admin.ram.change_status');
    });

    // Rom
    Route::group(['namespace' => 'Rom', 'prefix' => 'rom'], function () {
        Route::get('/', 'RomController@index')->name('admin.rom.index');
        Route::get('/get-list', 'RomController@getList')->name('admin.rom.get_list');
        Route::get('/find/{id?}', 'RomController@getById')->name('admin.rom.get_category');
        Route::post('/create', 'RomController@create')->name('admin.rom.create');
        Route::put('/change-status', 'RomController@changeStatus')->name('admin.rom.change_status');
    });
    
    // Color
    Route::group(['namespace' => 'Color', 'prefix' => 'color'], function () {
        Route::get('/', 'ColorController@index')->name('admin.color.index');
        Route::get('/get-list', 'ColorController@getList')->name('admin.color.get_list');
        Route::get('/find/{id?}', 'ColorController@getById')->name('admin.color.get_category');
        Route::post('/create', 'ColorController@create')->name('admin.color.create');
        Route::put('/change-status', 'ColorController@changeStatus')->name('admin.color.change_status');
    });

    // Branch
    Route::group(['namespace' => 'Branch', 'prefix' => 'branch'], function () {
        Route::get('/', 'BranchController@index')->name('admin.branch.index')->middleware('admin.manager.role');;
        Route::get('/get-list', 'BranchController@getList')->name('admin.branch.get_list')->middleware('admin.manager.role');;
        Route::get('/find/{id?}', 'BranchController@getById')->name('admin.branch.get_category')->middleware('admin.manager.role');;
        Route::post('/create', 'BranchController@create')->name('admin.branch.create')->middleware('admin.manager.role');;
        Route::put('/change-status', 'BranchController@changeStatus')->name('admin.branch.change_status')->middleware('admin.manager.role');;
    });
    

    Route::group(['namespace' => 'Product', 'prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('admin.product.index');
        Route::get('/get-list', 'ProductController@getList')->name('admin.product.get_list');
        Route::get('/find/{id?}', 'ProductController@getById')->name('admin.product.get_product');
        Route::post('/create', 'ProductController@create')->name('admin.product.create');
        Route::put('/change-status', 'ProductController@changeStatus')->name('admin.product.change_status');
    });

//    Route::group(['namespace' => 'Page', 'prefix' => 'page'], function () {
//        Route::get('/', 'PageController@index')->name('admin.page.index');
//        Route::get('/get-list', 'PageController@getList')->name('admin.page.get_list');
//        Route::get('/get-page', 'PageController@getById')->name('admin.page.get_page');
//        Route::post('/create', 'PageController@create')->name('admin.page.create');
//        Route::post('/update', 'PageController@update')->name('admin.page.update');
//    });

    Route::group(['namespace' => 'Order', 'prefix' => 'order'], function () {
        Route::get('/', 'OrderController@index')->name('admin.order.index');
        Route::get('/get-list', 'OrderController@getList')->name('admin.order.get_list');
        Route::get('/find/{id?}', 'OrderController@getById')->name('admin.order.get_order');
        Route::post('/create', 'OrderController@create')->name('admin.order.create');
        Route::put('/change-status', 'OrderController@changeStatus')->name('admin.order.change_status');
    });

    // Admin User
    Route::group(['namespace' => 'AdminUser', 'prefix' => 'adminUser'], function () {
        Route::get('/', 'AdminUserController@index')->name('admin.adminUser.index')->middleware('admin.manager.role');;
        Route::get('/get-list', 'AdminUserController@getList')->name('admin.adminUser.get_list')->middleware('admin.manager.role');;
        Route::get('/find/{id?}', 'AdminUserController@getById')->name('admin.adminUser.get_adminUser')->middleware('admin.manager.role');;
        Route::post('/create', 'AdminUserController@create')->name('admin.adminUser.create')->middleware('admin.manager.role');;
        Route::put('/change-status', 'AdminUserController@changeStatus')->name('admin.adminUser.change_status')->middleware('admin.manager.role');;
    });

    Route::group(['namespace' => 'PaymentMethod', 'prefix' => 'payment-method'], function () {
        Route::get('/', 'PaymentMethodController@index')->name('admin.payment_method.index');
        Route::get('/get-list', 'PaymentMethodController@getList')->name('admin.payment_method.get_list');
        Route::get('/find/{id?}', 'PaymentMethodController@getById')->name('admin.payment_method.get_item');
        Route::post('/create', 'PaymentMethodController@create')->name('admin.payment_method.create');
        Route::put('/change-status', 'PaymentMethodController@changeStatus')->name('admin.payment_method.change_status');
    });

    Route::group(['namespace' => 'Customer', 'prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index')->name('admin.customer.index');
        Route::get('/get-list', 'CustomerController@getList')->name('admin.customer.get_list');
        Route::get('/find/{id?}', 'CustomerController@getById')->name('admin.customer.get_customer');
        Route::post('/create', 'CustomerController@create')->name('admin.customer.create');
        Route::post('/change-status', 'CustomerController@update')->name('admin.customer.change_status');
    });

    Route::group(['namespace' => 'Promotion', 'prefix' => 'promotion'], function () {
        Route::get('/', 'PromotionController@index')->name('admin.promotion.index');
        Route::get('/get-list', 'PromotionController@getList')->name('admin.promotion.get_list');
        Route::get('/find/{id?}', 'PromotionController@getById')->name('admin.promotion.get_promotion');
        Route::post('/create', 'PromotionController@create')->name('admin.promotion.create');
        Route::put('/change-status', 'PromotionController@changeStatus')->name('admin.promotion.change_status');

    });

    Route::group(['namespace' => 'Setting', 'prefix' => 'setting'], function () {
        Route::get('/', 'SettingController@index')->name('admin.setting.index');
        Route::post('/update', 'SettingController@update')->name('admin.setting.update');
    });
    Route::get('/logout', [LoginController::class,'getLogout'])->name('admin.logout');
    Route::post('/update', [UserController::class,'update'])->name('admin.user.update');
});
Route::get('/login', [LoginController::class,'login'])->name('screen_admin_login');
Route::post('/login', [LoginController::class,'postLogin'])->name('admin.authenticate');
