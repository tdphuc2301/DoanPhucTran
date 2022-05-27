<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;


class WebController extends Controller
{


    public function index()
    {
        // 

        return view('web.index');
    }

    public function detailProduct()
    {
        return view('web.Pages.detail-product');
    }

    public function cartProduct()
    {
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

}