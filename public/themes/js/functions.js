var datePickerLang = 'vi_VN',
    startDate = '01/01/1930';

function pushState(options, targetTitle, targetUrl) {
    window.history.pushState(options, targetTitle, targetUrl);
}

function goToByScroll(id) {
    $('body,html').animate({
        scrollTop: $(id).offset().top - 110
    }, 500);
}

function ajaxPage(l, url, tabs) {
    var params = {
        url: 'ajax/' + url,
        type: 'POST',
        data: {
            id: l
        },
        success: function(response) {
            $(tabs).html(response).selectpicker("refresh");
        }
    }
    $.ajax(params);
}

function ajaxloadPage(page, per_page, url, tabs) {
    var params = {
        url: 'ajax_paging/' + url,
        type: "POST",
        data: {
            page: page,
            per_page: per_page
        },
        async: true,
        success: function(data) {
            $(tabs).html(data);
            $(tabs + ' .pagination li.active').click(function() {
                var pager = $(this).attr('p');
                ajaxloadPage(pager, per_page, url, tabs);
                goToByScroll(tabs);
            });
        }
    }
    $.ajax(params);
}

function ajaxloadPageList(page, per_page, url, id_list, tabs) {
    var params = {
        url: 'ajax_paging/' + url,
        type: "POST",
        data: {
            page: page,
            per_page: per_page,
            id_list: id_list
        },
        async: true,
        success: function(data) {
            $(tabs).html(data);
            $(tabs + ' .pagination li.active').click(function() {
                var pager = $(this).attr('p');
                ajaxloadPageList(pager, per_page, url, id_list, tabs);
                goToByScroll(tabs);
            });
        }
    }
    $.ajax(params);
}

function ajaxPage_danhmuc(l, o, m, url, tabs) {
    $.ajax({
        url: 'ajax/' + url,
        type: 'POST',
        dataType: 'json',
        data: {
            id: l,
            level: o,
            act: m
        },
        beforeSend: function() {
            $('.loadingcover').show();
        },
        success: function(response) {
            $('.loadingcover').hide();
            $(tabs).html(response.message).selectpicker("refresh");
        }
    });
}

function doSearch(options) {

    if (!options) options = {};

    var url = '';

    $.each(options, function(k, v) {

        url += '&' + k + '=' + v;

    });

    $.ajax({

        url: baseUrl + 'tim-kiem' + url,

        type: 'GET',

        dataType: 'json',

        success: function(data) {

            $('#grid-view').html(data.col4);

            $('#list-view').html(data.col5);

            $('#pagingPage').html(data.page);

            $('#show').html(data.show);

            GLOBAL.lazyloadImage();

        }
    });

}

function searchEnter(t) {
    var k = t.val();

    var url;

    if (!isBlank(k)) {

        url = '&keywords=' + k;

        window.location.href = baseUrl + 'tim-kiem' + url;

    } else {

        GLOBAL.showToastr(lang.nhap_tu_khoa, 'error');

    }

}

function searchAdvance() {
    var _n = '';
    var _s = '';
    var _o = $('select[name="list-product"]').val();
    var _q = $('select[name="kt-product"]').val();
    var _p = $('select[name="ncu-product"]').val();
    var _k = $('select[name="price-product"]').val();
    $('input[name="orderby"]:checked').each(function(index, element) {
        _n += $(this).val();
    });
    if (_o != '') {
        _s += '&idl=' + _o;
    }
    if (_q != '') {
        _s += '&size=' + _q;
    }
    if (_p != '') {
        _s += '&ncu=' + _p;
    }
    if (_k != '') {
        _s += '&price=' + _k;
    }
    if (_n != '') {
        _s += '&sortby=' + _n;
    }

    window.location.href = 'tim-kiem' + _s;
}

function readURL(input, view) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

            $(view).attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);

    }

}

function calculate(tabs, txt_number = []) {
    var number = 0;
    for (let i = 0, cbLen = txt_number.length; i < cbLen; i++) {
        number = number + txt_number[i];
    }
    $(tabs).text(formatCurrency(number));
}

function formatCurrency(number) {
    return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

function minus() {
    var $that = $(this),
        $number_cart = $('input[name="qty"]'),
        size = $('input[name="size"]:checked').val(),
        color = $('input[name="color"]:checked').val(),
        material = $('input[name="weight"]:checked').val(),
        currentVal = parseInt($number_cart.val());
    if (currentVal > 1) {
        var number_change = currentVal - 1;
        $($number_cart).val(number_change);
        $.ajax({
            url: 'ajax/updateQty.php',
            type: 'POST',
            data: {
                size: parseInt(size),
                color: parseInt(color),
                material: parseInt(material),
                qty: parseInt(number_change)
            },
            dataType: 'json',

            success: function(res) {

                $('#price').html(res.priceText);

            }
        });
    }
}

function plus() {
    var $that = $(this),
        size = $('input[name="size"]:checked').val(),
        color = $('input[name="color"]:checked').val(),
        material = $('input[name="weight"]:checked').val(),
        $number_cart = $('input[name="qty"]'),
        currentVal = parseInt($number_cart.val());
    if (currentVal < 999) {
        var number_change = currentVal + 1;
        $($number_cart).val(number_change);
        $.ajax({
            url: 'ajax/updateQty.php',
            type: 'POST',
            data: {
                size: parseInt(size),
                color: parseInt(color),
                material: parseInt(material),
                qty: parseInt(number_change)
            },
            dataType: 'json',

            success: function(res) {

                $('#price').html(res.priceText);

            }
        });
    }
}

function isBlank(a) {
    if (a.length == 0) {
        return true
    }
    return false
}

function isEmail(b) {
    var a = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return a.test(b)
}

function isValidPhone(a) {
    var validRegExp = /^[0-9]{10,13}$/i;
    if (a.search(validRegExp) == -1) {
        return false
    }
    return true
}
var check_order = (t, n, r, d, f, u) => {
    if (isBlank(t)) {
        GLOBAL.showToastr(lang.nhap_ho_ten, 'error');
        return false;
    } else if (isBlank(n)) {
        GLOBAL.showToastr(lang.nhap_so_dien_thoai, 'error');
        return false;
    } else if (!isValidPhone(n)) {
        GLOBAL.showToastr(lang.so_dien_thoai_khong_hop_le, 'error');
        return false;
    } else if (isBlank(r)) {
        GLOBAL.showToastr(lang.nhap_email, 'error');
        return false
    } else if (!isEmail(r)) {
        GLOBAL.showToastr(lang.email_khong_dung_dinh_dang, 'error');
        return false;
    } else if (isBlank(d)) {
        GLOBAL.showToastr(lang.nhap_dia_chi, 'error');
        return false
    } else if (isBlank(f)) {
        GLOBAL.showToastr(lang.chon_tinh_thanh, 'error');
        return false;
    } else if (isBlank(u)) {
        GLOBAL.showToastr(lang.chon_quan_huyen, 'error');
        return false;
    } else {
        return true;
    }
}
var check_register = (a, b, c, d, e, f) => {
    if (isBlank(a)) {
        GLOBAL.showToastr(lang.nhap_email, 'error');
        return false;
    } else if (isBlank(b)) {
        GLOBAL.showToastr(lang.nhap_mat_khau, 'error');
        return false;
    } else if (isBlank(c)) {
        GLOBAL.showToastr(lang.nhap_ho_ten, 'error');
        return false;
    } else if (isBlank(d)) {
        GLOBAL.showToastr(lang.chon_ngay_sinh, 'error');
        return false;
    } else if (isBlank(e)) {
        GLOBAL.showToastr(lang.chon_gioi_tinh, 'error');
        return false;
    } else if (isBlank(f)) {
        GLOBAL.showToastr(lang.nhap_so_dien_thoai, 'error');
        return false;
    } else if (!isValidPhone(f)) {
        GLOBAL.showToastr(lang.so_dien_thoai_khong_hop_le, 'error');
        return false;
    } else {
        $('#frm-register').submit();
    }
}