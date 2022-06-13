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



Route::get('/', [WebController::class,'index'])->name('dashboard');
Route::get('/phones/{brand}', [WebController::class,'index'])->name('dashboard');
Route::get('/searchBranchClosestUser', [WebController::class,'searchBranchClosestUser'])->name('web.searchBranchClosestUser.get');;
Route::get('/searchFilterField', [WebController::class,'searchFilterField'])->name('web.searchFilterField.get');;
Route::get('phone/{brand}/{alias}', [WebController::class,'detailProduct']);
Route::get('cart', [WebController::class,'getCart'])->name('web.cart.get');
Route::post('cart', [WebController::class,'postCart'])->name('web.cart.post');
Route::get('checkout', [WebController::class,'getCheckout'])->name('web.checkout.get');
Route::post('checkout', [WebController::class,'postCheckout'])->name('web.checkout.post');
Route::get('success', [WebController::class,'successProduct']);

// Shipper
Route::get('shipper_transfer_order', [WebController::class,'shipper_product'])->name('order_for_shipper');

// Api update

Route::get('updateOrder', [WebController::class,'updateOrderPaid']);


Route::get('login', [WebController::class,'getLogin'])->name('login_web_get')->middleware('check.login');
Route::post('login', [WebController::class,'postLogin'])->name('login_web_post');
Route::get('logout', [WebController::class,'getLogout'])->name('logout_web_get');

Route::get('register', [WebController::class,'getRegister'])->name('register_web_get');
Route::post('register', [WebController::class,'postRegister'])->name('register_web_post');


Route::get('searchOrder', [WebController::class,'searchOrder'])->name('search_order');
Route::get('history', [WebController::class,'historyOrder'])->name('history_order');
