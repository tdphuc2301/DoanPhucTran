<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.Layouts.header_detail_product')
    <title>Shop cart - Bootdey.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
@include('web.Layouts.banner-media')
@include('web.Layouts.menu-top')
<div class="container pb-5 mt-n2 mt-md-n3" style="margin-top: 30px;background-color:#f1f1f1">
    <div class="row" style="margin-top: 30px">
        <div class="col-xl-9 col-md-8">
            <h2 class="h6 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-secondary">
                <span></span><a class="font-size-sm" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-left" style="width: 1rem; height: 1rem;">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                    Continue shopping</a></h2>
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h3 class="mb-0">Cart - 1 items</h3>
                    </div>
                    <div class="card-body">
                        <!-- Single item -->
                        <div class="row">
                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                <!-- Image -->
                                <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                     data-mdb-ripple-color="light">
                                    <img src="{{$product['images'][0]['path'] ?? ''}}"
                                         class="w-100" alt="Blue Jeans Jacket"/>
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                    </a>
                                </div>
                                <!-- Image -->
                            </div>

                            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                <!-- Data -->
                                <p><strong>{{$product['name']}}</strong></p>
                                <p>Color: {{$color_name}}</p>
                                <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                                        title="Remove item">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                                        title="Move to the wish list">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <!-- Data -->
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                <!-- Quantity -->
                                <div class="d-flex mb-4" style="max-width: 300px">
                                    <button class="btn btn-primary px-1 me-0" style="height:40px"
                                            onclick="decrementQuantity()">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>

                                    <div class="form-outline">
                                        <input id="form1" min="0" name="quantity" value="{{$quantity}}" type="number"
                                               class="form-control"/>
                                        <label class="form-label" for="form1">Quantity</label>
                                    </div>

                                    <button class="btn btn-primary px-1 ms-0" style="height:40px"
                                            onclick="incrementQuantity()">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <!-- Quantity -->

                                <!-- Price -->
                                <p class="text-start text-md-center">
                                    <strong>{{$product['sale_off_price']}} vnđ</strong>
                                </p>
                                <!-- Price -->
                            </div>
                        </div>
                        <!-- Single item -->

                        <hr class="my-4"/>


                        <!-- Single item -->
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Expected shipping delivery</strong></p>
                        <p class="mb-0 cacu">40 phút sau</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body">
                        <p><strong>We accept</strong></p>

                        <img class="me-2" width="100px"
                             src="data:image/png;base64,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"
                             alt="PayPal acceptance mark"/>
                    </div>
                </div>
            </div>

        </div>
        <!-- Sidebar-->
        <div class="col-xl-3 col-md-4 pt-3 pt-md-0">
            <h2 class="h6 px-4 py-3 bg-secondary text-center">Subtotal</h2>
            <h4 class="h6  text-left ">Giá sản phẩm: <strong
                        style="text-decoration: underline;">{{$product['sale_off_price']}} vnđ</strong></h4>
            <h4 class="h6  text-left ">Phí vận chuyển:<strong style="text-decoration: underline;"> {{$shipment}}
                    vnđ </strong></h4>
            <h4 class="h6  text-left">Giảm giá: <strong id="promotion" style="text-decoration: underline;">0</strong> vnđ
            </h4>
            <h4 class="h6  text-left">Số lượng: <strong id="quantity" style="text-decoration: underline;">0</strong>
            </h4>
            <hr>
            <h3 class="h4  text-left">Tổng tiền:</h3>
            <div class="h3 font-weight-semibold text-center py-1" ><span
                        id="total_price"></span> 
            </div>
            <hr>
            <h3 class="h6 pt-4 font-weight-semibold"><span class="badge badge-success mr-2">Note</span>Additional
                comments</h3>
            <form method="post" action="{{route('web.cart.post')}}">
                @csrf
                <input type="hidden" name="quantity_checkout">
                <input type="hidden" name="price_promotion_checkout">
                <input type="hidden" name="total_price_checkout">
                <input type="hidden" name="product_id">
                <textarea class="form-control mb-3" name="note"  rows="5"></textarea>
                <button class="btn btn-primary btn-block" href="#">Proceed to Checkout</button>
            </form>
            <div class="pt-4">
                <div class="accordion" id="cart-accordion">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="accordion-heading font-weight-semibold"><a href="#promocode" role="button"
                                                                                  data-toggle="collapse"
                                                                                  aria-expanded="true"
                                                                                  aria-controls="promocode">Apply promo
                                    code<span class="accordion-indicator"><svg xmlns="http://www.w3.org/2000/svg"
                                                                               width="24" height="24"
                                                                               viewBox="0 0 24 24" fill="none"
                                                                               stroke="currentColor" stroke-width="2"
                                                                               stroke-linecap="round"
                                                                               stroke-linejoin="round"
                                                                               class="feather feather-chevron-up"><polyline
                                                    points="18 15 12 9 6 15"></polyline></svg></span></a></h3>
                        </div>
                        <div class="collapse show" id="promocode" data-parent="#cart-accordion">
                            <div class="card-body">
                                <div class="box03 color group desk">
                                    <ul>
                                        @foreach($promotions as $key => $promotion)
                                            @if($key === 0)
                                            <li class="box03__item item promotion act " promotion_id="{{$promotion['id']}}"
                                                promotion_value="{{$promotion['value']}}"
                                                type_promotion_id="{{$promotion['type_promotion_id']}}">{{$promotion['name']}}</li>
                                            @else
                                                <li class="box03__item item promotion " promotion_id="{{$promotion['id']}}"
                                                    promotion_value="{{$promotion['value']}}"
                                                    type_promotion_id="{{$promotion['type_promotion_id']}}">{{$promotion['name']}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                {{--                                @foreach($promotions as $promotion)--}}
                                {{--                                    <button class="btn btn-outline-primary btn-block">{{$promotion['name']}}</button>--}}
                                {{--                                @endforeach--}}
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="card">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            <h3 class="accordion-heading font-weight-semibold"><a class="collapsed" href="#shipping" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="shipping">Shipping estimates<span class="accordion-indicator"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg></span></a></h3>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="collapse" id="shipping" data-parent="#cart-accordion">--}}
                    {{--                            <div class="card-body">--}}
                    {{--                                <form class="needs-validation" novalidate="">--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <select class="form-control custom-select" required="">--}}
                    {{--                                            <option value="">Choose your country</option>--}}
                    {{--                                            <option value="Australia">Australia</option>--}}
                    {{--                                            <option value="Belgium">Belgium</option>--}}
                    {{--                                            <option value="Canada">Canada</option>--}}
                    {{--                                            <option value="Finland">Finland</option>--}}
                    {{--                                            <option value="Mexico">Mexico</option>--}}
                    {{--                                            <option value="New Zealand">New Zealand</option>--}}
                    {{--                                            <option value="Switzerland">Switzerland</option>--}}
                    {{--                                            <option value="United States">United States</option>--}}
                    {{--                                        </select>--}}
                    {{--                                        <div class="invalid-feedback">Please choose your country!</div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <select class="form-control custom-select" required="">--}}
                    {{--                                            <option value="">Choose your city</option>--}}
                    {{--                                            <option value="Bern">Bern</option>--}}
                    {{--                                            <option value="Brussels">Brussels</option>--}}
                    {{--                                            <option value="Canberra">Canberra</option>--}}
                    {{--                                            <option value="Helsinki">Helsinki</option>--}}
                    {{--                                            <option value="Mexico City">Mexico City</option>--}}
                    {{--                                            <option value="Ottawa">Ottawa</option>--}}
                    {{--                                            <option value="Washington D.C.">Washington D.C.</option>--}}
                    {{--                                            <option value="Wellington">Wellington</option>--}}
                    {{--                                        </select>--}}
                    {{--                                        <div class="invalid-feedback">Please choose your city!</div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <input class="form-control" type="text" placeholder="ZIP / Postal code" required="">--}}
                    {{--                                        <div class="invalid-feedback">Please provide a valid zip!</div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <button class="btn btn-outline-primary btn-block" type="submit">Calculate shipping</button>--}}
                    {{--                                </form>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    body {
        margin-top: 20px;
    }

    .cart-item-thumb {
        display: block;
        width: 10rem
    }

    .cart-item-thumb > img {
        display: block;
        width: 100%
    }

    .product-card-title > a {
        color: #222;
    }

    .font-weight-semibold {
        font-weight: 600 !important;
    }

    .product-card-title {
        display: block;
        margin-bottom: .75rem;
        padding-bottom: .875rem;
        border-bottom: 1px dashed #e2e2e2;
        font-size: 1rem;
        font-weight: normal;
    }

    .text-muted {
        color: #888 !important;
    }

    .bg-secondary {
        background-color: #f7f7f7 !important;
    }

    .accordion .accordion-heading {
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: bold;
    }

    .font-weight-semibold {
        font-weight: 600 !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    
    let price_product = '<?php echo str_replace('.', '', $product['sale_off_price']); ?>';
    let shipment = '<?php echo str_replace('.', '', $shipment); ?>';
    let currentQuantity = $("input[name='quantity']").val();
    let totalPrice = parseInt(price_product) * currentQuantity + parseInt(shipment);
    $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    $("#quantity").html($("input[name='quantity']").val());

    $(document).ready(function () {
        $("input[name='quantity']").change(function () {
            $("#quantity").html($(this).val());
            currentQuantity = $(this).val();
            totalPrice = parseInt(price_product) * currentQuantity + parseInt(shipment);
            $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
        });
    })

    {{--$("input[name='product_id']").val('<?php echo $product['id'] ?>');--}}
    {{--let colorNameInit = '<?php echo $product['colors'][0]['name'] ?>';--}}
    {{--$("input[name='color_id']").val(colorNameInit);--}}
    {{--$(document).delegate('.color_name ', 'click', function (e) {--}}
    {{--    --}}
    {{--});--}}

    function incrementQuantity() {
        currentQuantity++;
        $("input[name='quantity']").val(currentQuantity);
        $("#quantity").html(currentQuantity);
        totalPrice = parseInt(price_product) * currentQuantity + parseInt(shipment);
        $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    }

    function decrementQuantity() {
        currentQuantity--;
        $("input[name='quantity']").val(currentQuantity);
        $("#quantity").html(currentQuantity);
        totalPrice = parseInt(price_product) * currentQuantity + parseInt(shipment);
        $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    }

    $("input[name='quantity_checkout']").val(currentQuantity);
    $("input[name='total_price_checkout']").val(totalPrice);
    $("input[name='price_promotion_checkout']").val(0);
    $("input[name='product_id']").val('{{$product['id']}}');
    

    // $(document).delegate('.promotion', 'click', function (e) {
    //     $('.promotion').removeClass('act');
    //     promotion.value.new = $(this).attr("promotion_value");
    //     promotion.type_promotion_id = $(this).attr("type_promotion_id");
    //     promotion.id.new = $(this).attr("promotion_id");
    //     if (promotion.value.new !== promotion.value.old) {
    //         $(this).addClass('act');
    //         promotion.value.old = promotion.value.new;
    //         if (promotion.id.new === 1) {
    //             $("#promotion").html(promotion.value.new)
    //             promotion = parseInt(price_product) * currentQuantity + parseInt(shipment);
    //             $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    //             console.log('3');
    //
    //         } else if (promotion.id.new === 2) {
    //             $("#promotion").html(promotion.value.new * price_product / 100);
    //             promotion = parseInt(price_product) * currentQuantity + parseInt(shipment);
    //             $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    //             console.log('4')
    //         } else {
    //             $("#promotion").html(promotion.value.new * price_product / 100);
    //             promotion = parseInt(price_product) * currentQuantity + parseInt(shipment);
    //             $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    //            
    //         }
    //     } else {
    //        
    //         $("#promotion").html(0);
    //         if (promotion.id.new === 1) {
    //             promotion = parseInt(price_product) * currentQuantity + parseInt(shipment);
    //             $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    //             console.log('3')
    //         } else if (promotion.id.new === 2) {
    //             promotion = parseInt(price_product) * currentQuantity + parseInt(shipment);
    //             $("#total_price").html(totalPrice.toLocaleString('it-IT', {style: 'currency', currency: 'VND'}));
    //             console.log('4')
    //         }
    //        
    //     }
    // })
    
    // if(promotion.id.new === 1) {
    //    
    // }
    
</script>
</body>
</html>