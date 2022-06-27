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

        .system_message {
            position: fixed;
            right: 15px;
            top: 15px;
            transition: all 0.3s;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -o-transition: all 0.3s;
            transform: translate(115%, 0);
            -webkit-transform: translate(115%, 0);
            -moz-transform: translate(115%, 0);
            -o-transform: translate(115%, 0);
            width: 270px;
            padding: 10px 15px;
            z-index: 9999;
            border-radius: 3px;
            color: #fff;
        }

        .system_message.show {
            transform: translate(0%, 0);
            -webkit-transform: translate(0%, 0);
            -moz-transform: translate(0%, 0);
            -o-transform: translate(0%, 0);
        }

        .system_message.info {
            background: #5ecafb;
            border: 1px solid #3eb5ea;
        }

        .system_message.success {
            background: #02984d;
            border: 1px solid #0b7540;
        }

        .system_message.danger {
            background: #e65449;
            border: 1px solid #d64d42;
        }

        .system_message.warning {
            background: #ffbb56;
            border: 1px solid #d8922b;
        }

        .system_confirm {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.3);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
        }

        .system_confirm.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body>
@include('web.Layouts.header_detail_product')
@include('web.Layouts.banner-media')
@include('web.Layouts.menu-top')

<!-- DEMO HTML -->
<div class="container" style="margin: 0 auto; width: 1140px;background-color: #f1f1f1">
    <div class="system_message">
        <div class="title">Cập nhật thành công</div>
    </div>
    <div class="py-5 text-center">

        <h2 style="font-size:30px;font-weight:bold">Thanh toán</h2>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span  style="font-size:20px;font-weight:bold">Đơn hàng</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$product['name']}}</h6>
                        <small class="text-muted"> <strong> Số lượng: {{$quantity}}</strong></small>
                    </div>
                    <span class="text-muted"><strong>{{$product['sale_off_price']}} vnđ</strong> </span>
                </li>

                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Phí vận chuyển</h6>
                    </div>
                    <span class="text-muted"><strong>{{$shipment}} vnđ</strong></span>
                </li>

                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Phí khuyến mãi</h6>
                    </div>
                    <span class="text-muted"><strong>{{$price_promotion_checkout}} vnđ</strong></span>
                </li>
                <hr/>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-muted">Tổng tiền (vnđ)</span>
                    <strong>{{$total_price_checkout}} vnđ</strong>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span>Tương đương(USD)</span>
                    <strong id="chargeUsdPaypal">{{round($total_price_checkout/23000,2)}} $</strong>
                </li>
                
            </ul>

        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3" style="font-size:20px;font-weight:bold">Hóa đơn</h4>
            <form method="post" action="{{route('web.checkout.post')}}" id="create_form">
                @csrf
                
                <div class="mb-3">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{$customer->name ?? ''}}"
                           required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="" value="{{$customer->email ?? ''}}" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" name="search_address" id="search_address" value="{{$customer->address ?? ''}}"
                           placeholder="nhập địa chỉ" required>
                    <div id="result"></div>
                </div>

                <div class="mb-3">
                    <label for="phone">Số điện thoại</label>
                    <input type="number" class="form-control" name="phone" id="phone" value="{{$customer->phone ?? ''}}"
                           required>
                </div>
                <input type="hidden" name="longitude" id="longitude" value="{{$customer->long ?? ''}}">
                <input type="hidden" name="latitude" id="latitude" value="{{$customer->lat ?? ''}}">
                <input type="hidden" name="paymentMethod" id="paymentMethod">
                

                <hr class="mb-4">
                <h4 class="mb-3">Phương thức thanh toán</h4>

                <div id="paypal-button" ></div>
                <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                <script>
                    let isPaypal = false;
                    paypal.Button.render({
                        // Configure environment
                        env: 'sandbox',
                        client: {
                            sandbox: 'AQWPDnHLcxXjx4Z9UaqVAcaZL-hbnfX9LBnyh3Zfd7Sy5YSrA4UUHpj6NVTez3WiI4qXyoy68YuxcwWY',
                            production: 'demo_production_client_id'
                        },
                        // Customize button (optional)
                        locale: 'en_US',
                        style: {
                            size: 'large',
                            color: 'gold',
                            shape: 'pill',
                        },

                        // Enable Pay Now checkout flow (optional)
                        commit: true,

                        // Set up a payment
                        payment: function (data, actions) {
                            return actions.payment.create({
                                transactions: [{
                                    amount: {
                                        total: '{{round($total_price_checkout/23000,2)}}',
                                        currency: 'USD'
                                    }
                                }]
                            });
                        },
                        // Execute the payment
                        onAuthorize: function (data, actions) {
                            return actions.payment.execute().then(function () {
                                showNotification("Thanh toán thành công",'success');
                                 isPaypal = true;
                                $("input[name='paymentMethod']").val('paypal');
                                $('#submit').click();
                            });
                        }
                    }, '#paypal-button');

                </script>

                <button class="btn btn-primary btn-lg btn-block" style="width: 48%; border-radius:40px;"  id="submit" type="submit">Thanh toán bằng tiền mặt
                </button>
                
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

<footer class="credit">Author: Manasseh El Bey - Distributed By: <a title="Awesome web design code & scripts"
                                                                    href="https://www.codehim.com?source=demo-page"
                                                                    target="_blank">CodeHim</a></footer>

<!-- Bootstrap 5 JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    $("#submit").click(function() {
        $("input[name='paymentMethod']").val('COD');
        if(isPaypal) {
            $("input[name='paymentMethod']").val('paypal');
        }
    });

    let timeout;

    $("#search_address").on('keyup', function () {
        var searchValue = $(this).val();

        if (searchValue.length > 0) {
            searchAddress();
        } else {
            $("#result_search li").hide();
        }


    });

    function searchAddress() {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            let payload = {
                'system': 'VTP',
                'ctx': 'SUBWARD',
                'q': document.getElementById('search_address').value

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
                        if (index <= 4) {
                            array_search.push({"name": item.name, "longitude": item.l.lng, "latitude": item.l.lat});
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
        }, 500)
    }

    function showNotification(message, type, time, icon) {
        icon = icon == null ? '' : icon;
        type = type == null ? 'info' : type;
        time = time == null ? 3000 : time;
        $('.system_message').addClass('show').addClass(type);
        $('.system_message').find('.title').html(message);
        setTimeout(function () {
            $('.system_message').removeClass('show').removeClass(type);
            $('.system_message')
        }, time)

    }

    $(document).delegate('#search_list li', 'click', function (e) {
        document.getElementById("search_address").value = $(this).text();
        document.getElementById("longitude").value = $(this).attr("long");
        document.getElementById("latitude").value = $(this).attr("lat");
        document.getElementById("search_list").style.display = 'none';
    });
    
    


</script>
</body>
</html>