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

<!-- DEMO HTML -->
<div class="container" style="margin: 0 auto; width: 1140px;background-color: #f1f1f1">

    <div class="row">
        <div class="col-md-12 order-md-1">
            <h4 class="mb-3">Đăng kí</h4>
            <form method="post" action="{{route('register_web_post')}}" id="create_form">
                @csrf
                    <div class="mb-3">
                            <label for="firstName">Name</label>
                        <input type="text" class="form-control" name="name" id="firstName" placeholder="" value=""
                               required>
                    </div>
                <div class="mb-3">
                    <label for="username">Username </label>
                    <input type="text" class="form-control" name="username" id="username"  required>
                    
                </div>
                <div class="mb-3">
                    <label for="password">Password </label>
                    <input type="password" class="form-control" name="password" id="password"  required>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" name="search_address" id="search_address"
                           placeholder="nhập địa chỉ" required>
                    <div id="result"></div>
                </div>

                <div class="mb-3">
                    <label for="phone">Số điện thoại</label>
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="nhập số điện thoại"
                           required>
                </div>
                <input type="hidden" name="longitude" id="longitude">
                <input type="hidden" name="latitude" id="latitude">
                <button class="btn btn-primary btn-lg btn-block" style="width: 48%; border-radius:40px;text-align: center;"  id="submit" type="submit">Đăng kí
                </button>
                
            </form>
        </div>
    </div>
</div>
<!-- End Demo HTML -->

<!-- Bootstrap 5 JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

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

    $(document).delegate('#search_list li', 'click', function (e) {
        document.getElementById("search_address").value = $(this).text();
        document.getElementById("longitude").value = $(this).attr("long");
        document.getElementById("latitude").value = $(this).attr("lat");
        document.getElementById("search_list").style.display = 'none';
    });




</script>
</body>
</html>