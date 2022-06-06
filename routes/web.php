<?php

use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace' => 'Web'], function () {
    Route::get('/mail', function(){
        return view('mail.new-order');
    });
    Route::get('/posts', 'WebController@getPosts');
    // Route::get('/{alias?}', 'WebController@index')->name('home');
});

Route::get('/detail', function () {
    return view('pages.product-detail');
});
Route::get('/cart', function () {
    return view('pages.cart');
});
Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/post-detail', function () {
    return view('pages.post-detail');
});
Route::get('/search', function () {
    return view('pages.search');
});


// Customer
Route::get('/', [WebController::class,'index']);
Route::get('/searchBranchClosestUser', [WebController::class,'searchBranchClosestUser'])->name('web.searchBranchClosestUser.get');;
Route::get('/searchFilterField', [WebController::class,'searchFilterField'])->name('web.searchFilterField.get');;
Route::get('phone/{brand}/{alias}', [WebController::class,'detailProduct']);
Route::get('cart', [WebController::class,'getCart'])->name('web.cart.get');
Route::post('cart', [WebController::class,'postCart'])->name('web.cart.post');
Route::get('checkout', [WebController::class,'getCheckout'])->name('web.checkout.get');
Route::post('checkout', [WebController::class,'postCheckout'])->name('web.checkout.post');
Route::get('test_success_product', [WebController::class,'successProduct']);

// Shipper
Route::get('test_list_product_for_shipper', [WebController::class,'shipper_product']);



