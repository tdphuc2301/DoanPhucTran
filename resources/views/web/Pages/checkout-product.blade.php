<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 5 Checkout Form Example</title>
    <style>
        #result {
            border: 1px dotted #ccc;
            padding: 3px;
        }
        #result ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: white;
        }
        #result ul li {
            padding: 5px 0;
        }
        #result ul li:hover {
            background: #eee;
        }
    </style>
</head>
<body>
@include('web.Layouts.header_detail_product')
@include('web.Layouts.banner-media')
@include('web.Layouts.menu-top')

    <!-- DEMO HTML -->
    <div class="container" style="margin: 0 auto; width: 1140px;background-color: #f1f1f1">
        <div class="py-5 text-center">

            <h2>Checkout form</h2>
            <p class="lead">Below  triggered by attempting to submit the form without completing it.</p>
        </div>

        <div class="row" >
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{$product['name']}}</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">{{$product['sale_off_price']}}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Phí vận chuyển</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">40000 vnđ</span>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">{{$price_promotion_checkout}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (vnđ)</span>
                        <strong>{{$total_price_checkout}}</strong>
                    </li>
                </ul>
                
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form  method="post" action="{{route('web.checkout.post')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control"  name="lastName" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" name="search_address" id="search_address" placeholder="nhập địa chỉ" required>
                        <div id="result"></div>
                    </div>

                    <div class="mb-3">
                        <label for="phone">Số điện thoại</label>
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="nhập số điện thoại" required>
                    </div>
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="latitude" id="latitude">

                    <hr class="mb-4">
                    <h4 class="mb-3">Phương thức thanh toán</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <div>
                            <input id="paypal" name="paymentMethod" href="#paymentPaypal" role="button"   data-toggle="collapse" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal" style="font-weight: bold; font-size:16px">PayPal</label>
                            </div>
                            <div style="margin-top: 10px">
                                <input style="margin-left: 50px" id="COD" name="paymentMethod"    type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="COD" style="font-weight: bold; font-size:16px">Tiền mặt</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4">
                        <div class="accordion" id="cart-accordion">
                            <div class="card">
                                <div class="collapse" id="paymentPaypal" style="display:none">
                                    <div class="card-body">
                                        <div class="box03 color group desk">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="cc-name">Name on card</label>
                                                    <input type="text" class="form-control" name="name_card" placeholder="" >
                                                    <small class="text-muted">Full name as displayed on card</small>
                                                    <div class="invalid-feedback">
                                                        Name on card is required
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="cc-number">Credit card number</label>
                                                    <input type="text" class="form-control" name="credit_number_card" placeholder="" >
                                                    <div class="invalid-feedback">
                                                        Credit card number is required
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="cc-expiration">Expiration</label>
                                                    <input type="text" class="form-control" name="expiration_card" placeholder="" >
                                                    <div class="invalid-feedback">
                                                        Expiration date required
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="cc-cvv">CVV</label>
                                                    <input type="text" class="form-control" name="cvv_card" placeholder="" >
                                                    <div class="invalid-feedback">
                                                        Security code required
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2021 - 2045 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
    <!-- End Demo HTML -->

<footer class="credit">Author: Manasseh El Bey - Distributed By: <a title="Awesome web design code & scripts" href="https://www.codehim.com?source=demo-page" target="_blank">CodeHim</a></footer>

<!-- Bootstrap 5 JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    let count = 1;
    $(document).delegate('#paypal', 'click', function (e) {
      $("#paymentPaypal").css("display", 'block');
    });
    $(document).delegate('#COD', 'click', function (e) {
        $("#paymentPaypal").css("display", 'none');
        $("input[name='name_card']").val('');
        $("input[name='credit_number_card']").val('');
        $("input[name='expiration_card']").val('');
        $("input[name='cvv_card']").val('');
    })

    let timeout;

    $("#search_address").on('keyup', function() {
        var searchValue = $(this).val();

        if(searchValue.length > 0){
            searchAddress();
        }else{
            $("#result_search li").hide();
        }


    });

    function searchAddress() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            let payload = {
                'system': 'VTP',
                'ctx' : 'SUBWARD',
                'q' : document.getElementById('search_address').value

            }
            $.ajax({
                type: 'GET',
                data: payload,
                url: 'https://location.okd.viettelpost.vn/location/v1.0/autocomplete',
                context: this,
                dataType: "json",
                success: function (response) {
                    var array_search = [];
                    window.clearTimeout(timeout);
                    console.log(response);
                    response.forEach((item, index) => {
                        if(index <=4) {
                            array_search.push({"name" :item.name,"longitude":item.l.lng,"latitude":item.l.lat});
                        }
                    });

                    res = document.getElementById("result");
                    res.innerHTML = '';
                    let list = '';
                    array_search.forEach((item, index) => {
                        list += `<li long="${item.longitude}" lat="${item.longitude}">${item.name}</li>`;
                    });

                    res.innerHTML = '<ul id="search_list">' + list + '</ul>';

                },
                beforeSend: function () {

                },
                error: function (response) {
                    console.log(response);
                },
            });
        },500)
    }

    $(document).delegate('#search_list li', 'click', function (e) {
        document.getElementById("search_address").value = $(this).text();
        document.getElementById("longitude").value = $(this).attr( "long" );
        document.getElementById("latitude").value = $(this).attr( "lat" );
        document.getElementById("search_list").style.display ='none';
    });
</script>
</body>
</html>