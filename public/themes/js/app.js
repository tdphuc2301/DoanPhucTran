function addCart(id, sl) {
    $.ajax({
        url: 'ajax/addCart.php',
        type: 'POST',
        cache: !1,
        dataType: 'json',
        data: {
            pid: id,
            qty: sl
        },
        async: true,
        beforeSend: function() {},
        success: function(data) {
            GLOBAL.showToastr(lang.mua_thanh_cong + '[ ' + data.nameCart + ']' + ' thành công', 'success');
            $('#view-header').html(data.totalCart);
            $('.mask-num').html(data.totalCart);

        }

    });
}
$(function() {
    // ========slide cart======
    $('#giohang').click(function() {
        $('a[href="#step2"]').tab('show');
    });
    $('#xacnhan1').click(function() {

        var $id_user = $('input[name="id_user"]').val();

        var $t = $('input[name="fullname"]').val();

        var $n = $('input[name="phone"]').val();

        var $r = $('input[name="email"]').val();

        var $d = $('input[name="address"]').val();

        var $f = $('select[name="id_city"]').val();

        var $u = $('select[name="id_dist"]').val();

        var $x = $('textarea[name="description"]').val();

        var $y = $('input[name="giaohang"]:checked').val();

        var $k = $('input[name="point"]:checked').val();

        var $z = $('input[name="httt"]:checked').val();

        var $el = check_order($t, $n, $r, $d, $f, $u);
        if ($el) {
            $.ajax({
                url: 'ajax/hoan-tat-dat-hang.php',
                data: {
                    id_user: $id_user,
                    t: $t,
                    n: $n,
                    r: $r,
                    d: $d,
                    f: $f,
                    u: $u,
                    x: $x,
                    y: $y,
                    k: $k,
                    z: $z
                },
                type: 'POST',
                dataType: 'json',
                cache: !1,
                async: true,
                error: function() {
                    GLOBAL.showToastr(lang.loi_he_thong);
                },
                success: function(C) {
                    $('#ajaxJson').html('<div class="row">\
                                <div class="col-md-5 col-sm-5 col-xs-5 border-col pd-col">\
                                    Họ và tên\
                                </div>\
                                <div class="col-md-7 col-sm-7 col-xs-7 border-col pd-col">\
                                    ' + C.fullname + '\
                                </div>\
                                <div class="col-md-5 col-sm-5 col-xs-5 border-col pd-col">\
                                    Số điện thoại\
                                </div>\
                                <div class="col-md-7 col-sm-7 col-xs-7 border-col pd-col">\
                                    ' + C.phone + '\
                                </div>\
                                <div class="col-md-5 col-sm-5 col-xs-5 border-col pd-col">\
                                    Email\
                                </div>\
                                <div class="col-md-7 col-sm-7 col-xs-7 border-col pd-col">\
                                    ' + C.email + '\
                                </div>\
                                <div class="col-md-5 col-sm-5 col-xs-5 border-col pd-col">\
                                    Địa chỉ\
                                </div>\
                                <div class="col-md-7 col-sm-7 col-xs-7 border-col pd-col">\
                                    ' + C.address + '\
                                </div>\
                                <div class="col-md-5 col-sm-5 col-xs-5 border-col pd-col">\
                                    Tỉnh/thành phố\
                                </div>\
                                <div class="col-md-7 col-sm-7 col-xs-7 border-col pd-col">\
                                    ' + C.citytext + '\
                                </div>\
                                <div class="col-md-5 col-sm-5 col-xs-5 border-col pd-col">\
                                    Quận huyện\
                                </div>\
                                <div class="col-md-7 col-sm-7 col-xs-7 border-col pd-col">\
                                    ' + C.disttext + '\
                                </div>\
                                <div class="col-md-5 col-sm-5 col-xs-5 pd-col">\
                                   Nội dung\
                                </div>\
                                <div class="col-md-7 col-sm-7 col-xs-7 pd-col">\
                                    ' + C.description + '\
                                </div>\
                            </div>');
                    $('#ajax-giaohang').html(C.deliverytext);
                    $('#ajax-thanhtoan').html(
                        '<img src="images/paypal' + C.payments + '.png" alt="' + lang.phuong_thuc_thanh_toan + '"/> ' + C.paymentstext
                    );
                    $('a[href="#step3"]').tab('show');
                }
            });
        }
    });
    $('#xacnhan2').on('click', function() {
        $.ajax({
            url: 'ajax/send-mail.php',
            type: 'POST',
            data: {},
            dataType: 'json',
            cache: !1,
            async: true,
            beforeSend: function() {

            },
            error: function() {
                GLOBAL.showToastr(lang.loi_he_thong);
            },
            success: function(C) {
                if (C.error == 200) {
                    $('#order-code').html(C.code);
                    $('#order-phone').html(C.phone);
                    $('#order-email').html(C.email);
                    $('.num-cart').html(C.total);
                    $('a[href="#step4"]').tab('show');
                }
            }
        });
    });
    $('#payOnline').click(function() {
        var $id_user = $('input[name="id_user"]').val();

        var $t = $('input[name="fullname"]').val();

        var $n = $('input[name="phone"]').val();

        var $r = $('input[name="email"]').val();

        var $d = $('input[name="address"]').val();

        var $f = $('select[name="id_city"]').val();

        var $u = $('select[name="id_dist"]').val();

        var $x = $('textarea[name="description"]').val();

        var $y = $('input[name="giaohang"]:checked').val();

        var $k = $('input[name="point"]:checked').val();

        var $z = $('input[name="httt"]:checked').val();

        var $el = check_order($t, $n, $r, $d, $f, $u);
        if ($el) {
            $.ajax({
                url: 'ajax/thanh-toan-online.php',
                data: {
                    id_user: $id_user,
                    t: $t,
                    n: $n,
                    r: $r,
                    d: $d,
                    f: $f,
                    u: $u,
                    x: $x,
                    y: $y,
                    k: $k,
                    z: $z
                },
                type: 'POST',
                dataType: 'json',
                cache: !1,
                async: true,
                error: function() {
                    GLOBAL.showToastr(lang.loi_he_thong, 'error');
                },
                success: function(C) {}
            });
        }
    });
    $('a[role="tab"]').click(function(j) {
        j.preventDefault()
    });
    $('#id_city').on('change', function() {
        var j = $(this).val();
        ajaxPage(j, 'loadDist.php', '#id_dist');
    });
    $('#add-product-list').click(function() {
        var product_id = $(this).data('product-id');
        var qty_id = $('input[name="qty"]').val();
        $.ajax({
            url: 'ajax/add_cart_list.php',
            type: 'post',
            dataType: 'json',
            data: {
                product_id: product_id,
                qty_id: qty_id
            },
            async: false,
            cache: false,
            success: function(res) {
                window.location.href = 'tra-cuu-don-hang.html';
            }
        })
    });
    $('#buy-all').click(function() {
        var product_id = [];
        var product_qty = [];
        $('.select-all').each(function() {
            product_id.push($(this).data('product-id'));
            product_qty.push($(this).data('product-qty'));
        });
        if (product_id.length > 0) {
            $.ajax({
                url: 'ajax/add_all_cart.php',
                type: 'POST',
                data: {
                    product_id: product_id,
                    product_qty: product_qty
                },
                cache: !1,
                async: 1,
                success: function(res) {
                    window.location.href = 'gio-hang.html';
                }
            });
        }
    });
    $('#buy-all-user').click(function() {
        var product_id = [];
        var product_qty = [];
        $('.select-all-user').each(function() {
            product_id.push($(this).data('product-id'));
            product_qty.push($(this).data('product-qty'));
        });
        if (product_id.length > 0) {
            $.ajax({
                url: 'ajax/add_all_cart.php',
                type: 'POST',
                data: {
                    product_id: product_id,
                    product_qty: product_qty
                },
                cache: !1,
                async: 1,
                success: function(res) {
                    window.location.href = 'gio-hang.html';
                }
            });
        }
    });
    $('#delete-all').click(function() {
        var cf = confirm(lang.ban_chac_co_muon_xoa)
        if (cf === true) {
            $.ajax({
                url: 'ajax/clear_cart_list.php',
                data: {},
                type: 'POST',
                success: function() {
                    window.location.reload(true);
                }
            })
        }
    });
    $('.quickview-heart').on('click', function(e) {
        var that = $(this);
        var id_user = that.attr('data-user');
        var id_product = that.attr('data-product');
        var act = that.attr('data-act');
        var ip = that.attr('data-ip');
        if (id_user == '' || id_user == 0) {
            alert(lang.chua_dang_nhap);
            window.location.href = 'dang-nhap.html';
        } else {
            $.ajax({
                url: 'ajax/ajax_addwishlist.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id_user: id_user,
                    id_product: id_product,
                    ip: ip,
                    act: act
                },
                cache: !1,
                async: 1,
                success: function(C) {
                    if (C.error == 1) {
                        that.addClass('active');
                        that.attr('data-act', 'remove');
                    }
                    if (C.error == 2) {
                        that.removeClass('active');
                        that.attr('data-act', 'insert');
                    }
                }
            });
        }
    });
    $('body').on('click', '.btnAddToCart', function() {
        var sl = $('#qty').val(),
            id = $(this).data('id'),
            price = $(this).data('price'),
            advance = $(this).data('cart-advance'),
            color = $('input[name="color"]:checked').val(),
            size = $('input[name="size"]:checked').val(),
            material = $('input[name="material"]:checked').val();
        // if(advance==='yes'){
        //     if(color==undefined || color==''){
        //         GLOBAL.showToastr('Vui lòng chọn màu sắc!','error');
        //         return false;
        //     }
        //     if(size==undefined || size==''){
        //         GLOBAL.showToastr('Vui lòng chọn size!','error');
        //         return false;
        //     }
        //     if(material==undefined || material==''){
        //         GLOBAL.showToastr('Vui lòng chọn chất liệu!','error');
        //         return false;
        //     }
        // }

        var params = {
            pid: parseInt(id),
            qty: parseInt(sl),
            price: parseInt(price),
            color: parseInt(color),
            size: parseInt(size),
            material: parseInt(material)
        }
        $.ajax({
            url: 'ajax/addCart.php',
            type: 'POST',
            cache: !1,
            dataType: 'json',
            data: params,
            async: true,
            beforeSend: () => {},
            error: function() {
                GLOBAL.showToastr('Thêm giỏ hàng thất bại', 'error');
            },
            success: (data) => {
                GLOBAL.showToastr(lang.mua_thanh_cong, 'success');
                $('#view-header').html(data.totalCart);
                $('.mask-num').html(data.totalCart);
            }

        });
    });
    $('body').on('click', '.js-btnAddToCart', function() {
        var pid = $(this).data('id');
        var qty = $(this).data('qty');
        var price = $(this).data('price');
        var color = $(this).data('color');
        var size = $(this).data('size');
        var material = $(this).data('material');

        var params = {
            pid: parseInt(pid),
            qty: parseInt(qty),
            price: parseInt(price),
            color: parseInt(color),
            size: parseInt(size),
            material: parseInt(material)
        }
        $.ajax({
            url: 'ajax/addCart.php',
            type: 'POST',
            cache: !1,
            dataType: 'json',
            data: params,
            async: true,
            beforeSend: () => {},
            error: function() {
                alert('sss');
            },
            success: (data) => {
                GLOBAL.showToastr(lang.mua_thanh_cong, 'success');
                $('#view-header').html(data.totalCart);
            }

        });
    });
    $('body').on('click', '.buyCart', function() {
        var sl = $('#qty').val(),
            id = $(this).data('id'),
            price = $(this).data('price'),
            advance = $(this).data('cart-advance'),
            color = $('input[name="color"]:checked').val(),
            size = $('input[name="size"]:checked').val(),
            material = $('input[name="material"]:checked').val();
        // if(advance==='yes'){
        //     if(color==undefined || color==''){
        //         GLOBAL.showToastr('Vui lòng chọn màu sắc!','error');
        //         return false;
        //     }
        //     if(size==undefined || size==''){
        //         GLOBAL.showToastr('Vui lòng chọn size!','error');
        //         return false;
        //     }
        //     if(material==undefined || material==''){
        //         GLOBAL.showToastr('Vui lòng chọn chất liệu!','error');
        //         return false;
        //     }
        // }
        var params = {
            pid: parseInt(id),
            qty: parseInt(sl),
            price: parseInt(price),
            color: parseInt(color),
            size: parseInt(size),
            material: parseInt(material)
        }
        $.ajax({
            url: 'ajax/addCart.php',
            type: 'POST',
            cache: !1,
            dataType: 'json',
            data: params,
            async: true,
            beforeSend: () => {},
            success: (data) => {
                window.location.href = "gio-hang.html"
            }

        });
    });
    $('body').on('click', '.delcart', function() {
        var id = $(this).data('id');
        var qty = $(this).data('qty');
        var price = $(this).data('price');
        var color = $(this).data('color');
        var size = $(this).data('size');
        var material = $(this).data('material');

        var params = {
            pid: parseInt(id),
            price: parseInt(price),
            color: parseInt(color),
            size: parseInt(size),
            material: parseInt(material)
        }
        $.ajax({
            url: 'ajax/deleteCart.php',
            type: 'POST',
            cache: !1,
            data: params,
            dataType: 'JSON',
            async: true,
            success: function(res) {
                window.location.reload(true);
            }
        });
    });
    $('body').on('click', '.btn-minus', function(e) {
        e.preventDefault();
        var $that = $(this),
            $number_cart = $that.next('input[name="quantity"]'),
            id = $that.next('input[name="quantity"]').attr('current-id'),
            price = $that.next('input[name="quantity"]').attr('data-price'),
            color = $that.next('input[name="quantity"]').attr('data-color'),
            size = $that.next('input[name="quantity"]').attr('data-size'),
            material = $that.next('input[name="quantity"]').attr('data-material'),
            currentVal = parseInt($number_cart.val());

        if (currentVal > 1) {
            var number_change = currentVal - 1;
            $($number_cart).val(number_change);
            $.ajax({
                url: 'ajax/updateCart.php',
                type: 'POST',
                data: {
                    pid: parseInt(id),
                    qty: parseInt(number_change),
                    price: parseInt(price),
                    color: parseInt(color),
                    size: parseInt(size),
                    material: parseInt(material)
                },
                dataType: 'json',

                success: function(res) {

                    window.location.href = 'gio-hang.html';

                }
            });
        }
    });
    $('body').on('click', '.btn-plus', function(e) {
        var $that = $(this),
            $number_cart = $that.prev('input[name="quantity"]'),
            id = $that.prev('input[name="quantity"]').attr('current-id'),
            price = $that.prev('input[name="quantity"]').attr('data-price'),
            color = $that.prev('input[name="quantity"]').attr('data-color'),
            size = $that.prev('input[name="quantity"]').attr('data-size'),
            material = $that.prev('input[name="quantity"]').attr('data-material'),
            currentVal = parseInt($number_cart.val());


        if (currentVal < 999) {
            var number_change = currentVal + 1;
            $($number_cart).val(number_change);
            $.ajax({
                url: 'ajax/updateCart.php',
                type: 'POST',
                data: {
                    pid: parseInt(id),
                    qty: parseInt(number_change),
                    price: parseInt(price),
                    color: parseInt(color),
                    size: parseInt(size),
                    material: parseInt(material)
                },
                dataType: 'json',

                success: function(res) {

                    window.location.href = 'gio-hang.html';

                }
            });
        }
    });
    // addwishlist
    $(".addwishlist").click(function(event) {
        event.preventDefault();
        var $this = $(this),
            $id = $this.attr('id-product');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            cache: false,
            url: 'ajax/addwishlist.php',
            data: {
                id: $id,
            },
            success: function(data) {
                if (data.status == 0) {
                    var r = confirm(lang.chua_dang_nhap_de_thich);
                    if (r == true) {
                        $("#btn_dn").click();
                    }
                } else if (data.status == 1) {
                    GLOBAL.showToastr(lang.thich_thanh_cong, 'success');
                    $this.addClass('wished');
                } else if (data.status == 2) {
                    GLOBAL.showToastr(lang.da_co_trong_yeu_thich, 'error');
                } else {
                    GLOBAL.showToastr(lang.loi_he_thong, 'error');
                }
            }
        });
    });
    $(".removewishlist").click(function(event) {
        event.preventDefault();
        var $this = $(this),
            $id = $this.attr('id-product');
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            cache: false,
            url: 'ajax/removewishlist.php',
            data: {
                id: $id,
            },
            success: function(data) {
                if (data.status == 0) {
                    var r = confirm(lang.chua_dang_nhap_de_thich);
                    if (r == true) {
                        $("#btn_dn").click();
                    }
                } else if (data.status == 1) {
                    GLOBAL.showToastr(lang.xoa_thanh_cong, 'success');
                    $this.parents('.box_sp').parents('.box_items_5').fadeOut('slow');
                } else if (data.status == 2) {
                    GLOBAL.showToastr(lang.loi_he_thong, 'error');
                }
            }
        });
    });
});