"use strict"
if (typeof GLOBAL === "undefined") {
    var GLOBAL = {};
}
var $document = $(document),
    $window = $(window),
    $body = $('body'),
    $numbClick = $('.js-counter-click>ul>li>a'),
    $lightGallery = $('#lightGallery');
$.fn.exists = () => {
    return this.length > 0;
}
GLOBAL.backToTop = () => {
    $body.append('<div id="back-to-top" style=""><a class="top arrow"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>');
    $window.scroll(() => {
        if ($window.scrollTop() > 100) {
            $('#back-to-top .top').addClass('animate_top');
        } else {
            $('#back-to-top .top').removeClass('animate_top');
        }
    });
    $('#back-to-top .top').click(() => {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    });
}
GLOBAL.clickMenu = () => {
    if ($('#responsive-menu .toggle-menu').length > 0) {
        $("#responsive-menu .toggle-menu").click(function() {
            $(this).find("i").toggleClass("fa-angle-down");
            $(this).find("i").toggleClass("fa-angle-right");
            if (!$(this).hasClass("active")) {
                $(this).parent().find("ul").first().slideDown(200);
                $('#responsive-menu .toggle-menu').removeClass('active');
                $(this).addClass("active");
            } else {
                $(this).parent().find("ul").first().slideUp(200);
                $(this).removeClass("active");
            }
            return !1;
        });
        $("#responsive-menu").attr("data-top", $("#responsive-menu").offset().top);
    }
    $document.on('click', '.title-rpmenu span,.thanh_left span, .modal-overlay', () => {
        if ($(".title-rpmenu").hasClass("active") == !1) {
            $(".title-rpmenu").addClass("active");
            $(".thanh_left").addClass("active");
            $("body").css({
                "overflow-x": "hidden"
            })
            $("#responsive-menu,#xmen").css({
                'transition': 'all 0.3s ease-in-out',
                'transform': 'translateX(280px)'
            });
            $('body').append("<div class='modal-overlay'></div>");
            return !1;
        } else {
            $(".title-rpmenu").removeClass("active");
            $(".thanh_left").removeClass("active");
            $("#responsive-menu,#xmen").css({
                'transform': 'translateX(0px)'
            });
            setTimeout(() => {
                $(".title-rpmenu").fadeIn();
                $("body").css({
                    "overflow-x": "auto"
                })
            }, 1000);
            $('.modal-overlay').remove();
        }
    });
}
GLOBAL.blockSite = () => {
    function clickIE() {
        if (document.all) {
            return false;
        }
    }

    function clickNS(e) {
        if (document.layers || (document.getElementById && !document.all)) {
            if (e.which == 2 || e.which == 3) {
                return false;
            }
        }
    }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS;
    } else {
        document.onmouseup = clickNS;
        document.oncontextmenu = clickIE;
        document.onselectstart = clickIE
    }
    document.oncontextmenu = new Function("return false")

    function disableselect(e) {
        return false
    }

    function reEnable() {
        return true
    }
    document.onselectstart = new Function("return false")
    if (window.sidebar) {
        document.onmousedown = disableselect
        document.onclick = reEnable
    }
    $(document).keydown(function(event) {
        if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
            return false;
        }
        if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
            return false;
        }
        if (event.keyCode == 83 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
            return false;
        }
        // "U" key
        if (event.ctrlKey && event.keyCode == 85) {
            return false;
        }
    });
}
GLOBAL.niceSelect = () => {
    loadCSS(baseUrl + "themes/nice-select/nice-select.css");
    loadScript(baseUrl + "themes/nice-select/jquery.nice-select.min.js", () => {
        $('.nice-select').niceSelect();
    });
}
GLOBAL.preLoader = () => {
    $('.info-id').click(function(e) {
        $('.info-id').removeClass('active');
        $(this).addClass('active');
        var id = $(this).data('id');
        var params = {
            url: 'ajax/load_bank.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(res) {
                $('.show-info-bank').html(res);
            }
        };
        $.ajax(params);
    });
    $('#id_city').on('change', function() {
        var j = $(this).val();
        ajaxPage(j, 'load_quan.php', '#id_dist');
    });
}
GLOBAL.dataTable = () => {
    loadCSS(baseUrl + "themes/datatable/jquery.dataTables.min.css");
    loadScript(baseUrl + "themes/datatable/jquery.dataTables.min.js", () => {
        var table = $('table.display').DataTable({
            searching: false,
            ordering: true,
            responsive: true,
            pageLength: 10,
            paging: true,
            info: false,
            lengthChange: false,
            lengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            language: {
                "decimal": "",
                "emptyTable": "Nội dung đang cập nhật...",
                "info": "Bắt đầu _START_ đến _END_ của _TOTAL_ sản phẩm",
                "infoEmpty": "Hiển thị 0 to 0 of 0 sản phẩm",
                "infoFiltered": "(filtered from _MAX_ total sản phẩm)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Hiển thị _MENU_ sản phẩm",
                "loadingRecords": "Loading...",
                "processing": "Processing...",
                "search": "Search:",
                "zeroRecords": "Dữ liệu không tồn tại",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Trước",
                    "previous": "Sau"
                }

            }
        });
        var table1 = $('table.display-themes').DataTable({
            searching: false,
            ordering: false,
            responsive: true,
            pageLength: 10,
            lengthChange: false,
            paging: false,
            info: false,
            lengthMenu: [
                [10, 25, 50, 100, 200, -1],
                [10, 25, 50, 100, 200, "All"]
            ],
            language: {
                "decimal": "",
                "emptyTable": "Nội dung đang cập nhật...",
                "info": "Bắt đầu _START_ đến _END_ của _TOTAL_ sản phẩm",
                "infoEmpty": "Hiển thị 0 to 0 of 0 sản phẩm",
                "infoFiltered": "(filtered from _MAX_ total sản phẩm)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Hiển thị _MENU_ sản phẩm",
                "loadingRecords": "Loading...",
                "processing": "Processing...",
                "search": "Search:",
                "zeroRecords": "Dữ liệu không tồn tại",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Trước",
                    "previous": "Sau"
                }

            }
        });
    });
}
GLOBAL.numbClick = () => {
    $('.js-numbClass').click(function() {
        var _o = $(this).attr('data-type');
        $.ajax({
            url: 'ajax/ajaxNumbClick.php',
            type: 'post',
            data: {
                type: _o
            },
            success: function(data) {

            }
        });
    });
}
GLOBAL.Popup = () => {
    loadCSS(baseUrl + "themes/magnific-popup/magnific-popup.css");
    loadScript(baseUrl + "themes/magnific-popup/jquery.magnific-popup.min.js", () => {
        $('.popup-map').magnificPopup({
            type: 'ajax',
            alignTop: 1,
            overflowY: 'scroll',
            mainClass: 'mfp-zoom-in',
            fixedContentPos: true,
            closeOnBgClick: false,
            fixedBgPos: true,
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300
        });
        $('.popup-signup').magnificPopup({
            type: 'inline',
            mainClass: 'mfp-zoom-in',
            fixedContentPos: true,
            closeOnBgClick: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300
        });

        $('.popup-login').magnificPopup({
            type: 'inline',
            mainClass: 'mfp-zoom-in',
            fixedContentPos: true,
            closeOnBgClick: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300
        });

        $('.popup-forgot').magnificPopup({
            type: 'inline',
            mainClass: 'mfp-zoom-in',
            fixedContentPos: true,
            closeOnBgClick: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300
        });

        $('body').on('click', '.show-signup', function(event) {
            var magnificPopup = $.magnificPopup.instance;
            magnificPopup.close();
            var _o = $(this);
            var _i = _o.data('rel');
            setTimeout(function() {
                $('.' + _i).trigger('click');
            }, 500);
        });
        $('body').on('click', '.show-forgot', function(event) {
            var magnificPopup = $.magnificPopup.instance;
            magnificPopup.close();
            var _o = $(this);
            var _i = _o.data('rel');
            setTimeout(function() {
                $('.' + _i).trigger('click');
            }, 500);
        });
        $('.popupCart').magnificPopup({
            type: 'inline',
            mainClass: 'mfp-zoom-in',
            fixedContentPos: true,
            closeOnBgClick: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300
        });
        $('.popup-newsletter').magnificPopup({
            type: 'inline',
            mainClass: 'mfp-zoom-in',
            fixedContentPos: true,
            closeOnBgClick: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300
        });
    });
}
GLOBAL.Newsletter = () => {
    var _o = '.submit-mail',
        _input_email = 'input[name="txt-email"]'
    $(_o).click(function(e) {
        e.preventDefault();
        var _that = $(this);
        var _k = $(_input_email).val();
        if (isBlank(_k)) {
            GLOBAL.showToastr('Vui lòng nhập email !', 'error');
            return false;
        } else if (!isEmail(_k)) {
            GLOBAL.showToastr('Email không đúng định dạng !', 'error');
            $(_input_email).focus();
            return false;
        } else {
            $.ajax({
                url: 'ajax/ajaxEmail.php',
                type: 'POST',
                data: {
                    email: _k,
                },
                dataType: 'json',
                beforeSend: function() {
                    _that.addClass('loading');
                },
                success: function(res) {
                    setTimeout(function() {
                        _that.removeClass('loading');
                        if (res.status == 200) {
                            GLOBAL.showToastr(res.message, 'success');
                        } else {
                            GLOBAL.showToastr(res.message, 'error');
                        }
                    }, 2000);
                }
            });
            $(_input_email).val('');
        }
    });
}
GLOBAL.newsletter = () => {
    var _o = '.btn-newsletter',
        _input_fullname = 'input[name="fullname"]',
        _input_email = 'input[name="email"]',
        // _input_date='input[name="date"]',
        // _input_phuhuynh='input[name="phuhuynh"]',
        // _input_city='select[name="city"]',
        _input_phone = 'input[name="phone"]',
        // _input_khoahoc='select[name="khoahoc"]',
        _input_address = 'input[name="address"]',
        _input_content = 'textarea[name="content"]';
    $(_o).click(function(e) {
        e.preventDefault();
        var _that = $(this);
        var _i = $(_input_fullname).val();
        // var _j=$(_input_date).val();
        // var _k=$(_input_phuhuynh).val();
        // var _l=$(_input_city).val();
        // var _m=$(_input_khoahoc).val();
        var _k = $(_input_email).val();
        var _p = $(_input_address).val();
        var _s = $(_input_phone).val();
        var _t = $(_input_content).val();
        if (isBlank(_i)) {
            GLOBAL.showToastr('Vui lòng nhập họ tên !', 'error');
            $(_input_fullname).focus();
            return false;
        }
        // else if(isBlank(_j)){
        //     GLOBAL.showToastr('Vui lòng nhập ngày !','error');
        //     $(_input_date).focus();
        //     return false;
        // }
        // else if(isBlank(_k)){
        //     GLOBAL.showToastr('Vui lòng nhập tên phụ huynh !','error');
        //     $(_input_phuhuynh).focus();
        //     return false;
        // }
        // else if(isBlank(_l)){
        //     GLOBAL.showToastr('Vui lòng chọn thành phố !','error');
        //     $(_input_city).focus();
        //     return false;
        // }
        // else if(isBlank(_m)){
        //     GLOBAL.showToastr('Vui lòng chọn khóa học !','error');
        //     $(_input_khoahoc).focus();
        //     return false;
        // }
        else if (isBlank(_k)) {
            GLOBAL.showToastr('Vui lòng nhập email !', 'error');
            return false;
        } else if (!isEmail(_k)) {
            GLOBAL.showToastr('Email không đúng định dạng !', 'error');
            $(_input_email).focus();
            return false;
        } else if (isBlank(_p)) {
            GLOBAL.showToastr('Vui lòng nhập địa chỉ !', 'error');
            $(_input_address).focus();
            return false;
        } else if (isBlank(_s)) {
            GLOBAL.showToastr('Vui lòng nhập số điện thoại !', 'error');
            $(_input_phone).focus();
            return false;
        }
        if (!isValidPhone(_s)) {
            GLOBAL.showToastr('Số điện thoại không đúng định dạng !', 'error');
            $(_input_phone).focus();
            return false;
        }
        if (isBlank(_t)) {
            GLOBAL.showToastr('Vui lòng nhập nội dung !', 'error');
            $(_input_content).focus();
            return false;
        } else {
            $.ajax({
                url: 'ajax/ajaxNewsletter.php',
                type: 'POST',
                data: {
                    fullname: _i,
                    // tenphuhuynh:_k,
                    // ngayhoc:_j,
                    // city:_l,
                    // course:_m,
                    email: _k,
                    address: _p,
                    phone: _s,
                    content: _t
                },
                dataType: 'json',
                beforeSend: function() {
                    _that.addClass('loading');
                },
                success: function(res) {
                    setTimeout(function() {
                        _that.removeClass('loading');
                        if (res.status == 200) {
                            GLOBAL.showToastr(res.message, 'success');
                        } else {
                            GLOBAL.showToastr(res.message, 'error');
                        }
                    }, 2000);
                }
            });
            $(_input_fullname).val('');
            $(_input_date).val('');
            $(_input_phuhuynh).val('');
            // $(_input_email).val('');
            $(_input_phone).val('');
            // $(_input_adress).val('');
            $(_input_content).val('');
        }
    });
}
GLOBAL.Tabs = () => {
    loadScript(baseUrl + "themes/js/tabs.js", () => {
        $().tabs({
            tabsClick: '.tabs-page',
            tabsContent: '.tabs-content-page',
            idTabs: '#idTabs',
            complete: function() {}
        });
    });
}
GLOBAL.parsley = () => {
    loadCSS(baseUrl + "themes/css/parsley.css");
    loadScript(baseUrl + "themes/js/parsley.min.js", () => {
        $('#login_form').on('submit', function(event) {
            event.preventDefault();
            $('#login_form').parsley();
            if ($('#login_form').parsley().isValid()) {
                $.ajax({
                    url: "login_action.php",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#login_button').attr('disabled', 'disabled');
                        $('#login_button').val('wait...');
                    },
                    success: function(data) {
                        $('#login_button').attr('disabled', false);
                        if (data.error != '') {
                            $('#error').html(data.error);
                            $('#login_button').val('Login');
                        } else {
                            window.location.href = "";
                        }
                    }
                })
            }
        });
    });
}
GLOBAL.bootstrap = () => {
    loadScript(baseUrl + "themes/bootstrap/js/bootstrap.min.js", () => {
        loadScript(baseUrl + "themes/bootstrap/js/bootstrap-select.min.js", () => {
            loadScript(baseUrl + "themes/bootstrap/js/bootstrap-datepicker.min.js", () => {
                loadScript(baseUrl + "themes/bootstrap/js/bootstrap-datepicker.vi.min.js", () => {
                    $(".selectpicker").selectpicker("refresh");
                    $('.datepicker').datepicker({
                        format: 'mm/dd/yyyy',
                        startDate: '-3d'
                    });
                })
            });
        });
    });
}
GLOBAL.marQuee = () => {
    loadScript(baseUrl + "themes/js/marquee.js", () => {
        $('.marquee').marquee({
            speed: 20000,
            gap: 50,
            delayBeforeStart: 0,
            direction: 'left',
            duplicated: true,
            pauseOnHover: true
        });
    })
}
GLOBAL.counter = () => {
    loadScript(baseUrl + "themes/js/jquery.countdown.min.js", () => {
        if ($(".li-countdown").length > 0) {
            $(".li-countdown")
                .countdown(timer, function(event) {
                    $(this).html(
                        event.strftime('<div class="count">%D <span></span></div> <div class="count">%H <span></span></div> <div class="count">%M <span></span></div><div class="count"> %S <span></span></div>')
                    );
                });
        }
        if ($('.li-counterup').length > 0) {
            $('.li-counterup').counterUp({
                delay: 10,
                time: 1000
            });
        }
    });
}
GLOBAL.Swiper = () => {
    loadCSS(baseUrl + "themes/css/swiper.min.css");
    var i;
    if ($('.swiper-containerslide').length > 0) {
        i = new Swiper('.swiper-containerslide', {
            slidesPerView: 1,
            spaceBetween: 30,
            centeredSlides: true,
            speed: 800,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            }
        })
    }
    if ($('.swiper-container').length > 0) {
        if (window.matchMedia("(max-width: 992px)").matches) {
            i = new Swiper(".swiper-container", {
                pagination: ".swiper-pagination",
                slidesPerView: 1,
                spaceBetween: 0,
                allowSwipeToPrev: false,
                allowSwipeToNext: false
            })
        } else {
            i = new Swiper(".swiper-container", {
                pagination: ".swiper-pagination",
                slidesPerView: 4,
                spaceBetween: 0,
                allowSwipeToPrev: false,
                allowSwipeToNext: false
            })
        }

    }

}
GLOBAL.Slider = () => {
    loadCSS(baseUrl + 'themes/css/jssor.css');
    loadScript(baseUrl + 'themes/js/jssor.slider-25.2.0.min.js', function() {
        loadScript(baseUrl + 'themes/js/jssor_1_slider_init.js', function() {
            jssor_1_slider_init();
        });
    });
}
GLOBAL.fixMenu = () => {
    var nav = $('.menu-sticky');
    $window.scroll(() => {
        if ($(this).scrollTop() > 160) {
            nav.addClass("sticky");
        } else {
            nav.removeClass("sticky");
        }
    });
}
GLOBAL.fixMenuMobile = () => {
    var nav = $('.menu-sticky-mobile');
    $window.scroll(() => {
        if ($(this).scrollTop() > 160) {
            nav.addClass("sticky");
        } else {
            nav.removeClass("sticky");
        }
    });
}
GLOBAL.tocList = () => {
    loadScript(baseUrl + "themes/js/jquery-toc.js", () => {
        $('#toc').toc({
            selectors: 'h2, h3, h4, h5, h6',
            container: $('.content'),
            status: true
        });
        $('a#toc').click(function() {
            $('.toc-list').toggle(200);
        });
        $('.toc-list').find('a').click(function(e) {
            e.preventDefault();
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
    });
}
GLOBAL.scrollText = () => {
    loadCSS(baseUrl + "themes/css/animate.css");
    loadScript(baseUrl + "themes/wow/wow.min.js", () => {
        new WOW().init();
    });
    loadScript(baseUrl + 'themes/chaychu/jquery.lettering.js', function() {
        loadScript(baseUrl + 'themes/chaychu/jquery.textillate.js', function() {
            $('.action > div:first-child').textillate({ in: {
                    effect: 'bounceIn'
                },
                out: {
                    effect: 'bounceOut'
                },
                loop: true
            });
            $('.action > div:last-child').textillate({ in: {
                    effect: 'fadeInLeft'
                },
                out: {
                    effect: 'fadeInRight'
                },
                loop: true
            });
        });
    });
}
GLOBAL.changeThumb = () => {
    $('.checked-option').change(function() {
        var _o = $(this),
            _i = _o.attr('data-id'),
            _j = _o.attr('data-type');
        var params = {
            id: _i,
            type: _j
        }
        $.ajax({
            url: 'ajax/ajaxLoadDetail.php',
            type: 'POST',
            data: params,
            dataType: 'json',
            success: function(data) {
                $('#box-detail-plus').html(data.message);
                $('.js-price-new').html(data.priceNewText);
                $('.js-price-old').html(data.priceOldText);
                MagicZoom.refresh();
                $('.slide-thumb').slick({
                    dots: false,
                    infinite: false,
                    speed: 300,
                    vertical: false,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: false,
                    autoplay: true,
                    autoplaySpeed: 2000
                });
            }
        });
    });
}
GLOBAL.Noti = () => {
    loadCSS(baseUrl + "themes/css/toast.css");
    loadScript(baseUrl + "themes/js/toast.js", () => {});
}
GLOBAL.showToastr = (message, status) => {
    $.toast({

        heading: lang.thong_bao,

        text: message,

        position: 'top-right',

        stack: false,

        icon: status

    });
}
GLOBAL.mCustom = () => {
    loadCSS(baseUrl + "themes/mcustomscrollbar/jquery.mCustomScrollbar.css");
    loadScript(baseUrl + "themes/mcustomscrollbar/jquery.mCustomScrollbar.js", () => {
        $('ul.ul-news').mCustomScrollbar();
    });
}
GLOBAL.fancyBox = () => {
    loadCSS(baseUrl + "themes/fancybox/dist/jquery.fancybox.css");
    loadScript(baseUrl + "themes/fancybox/dist/jquery.fancybox.min.js", () => {

    });
}
GLOBAL.photoBox = () => {
    loadCSS(baseUrl + "themes/photobox/photobox.css");
    loadScript(baseUrl + "themes/photobox/jquery.photobox.js", () => {
        $('.grid').photobox('a', {
            thumbs: true,
            loop: false
        });
    });
}
GLOBAL.lightGallery = () => {
    loadScript(baseUrl + 'themes/lightgallery/js/lightgallery.min.js', function() {
        $lightGallery.lightGallery();
    });
}
GLOBAL.mixProject = () => {
    loadCSS(baseUrl + 'themes/css/project.css');
    loadScript(baseUrl + 'themes/js/jquery.mix.js', function() {
        $("#list-projects").mixItUp();
    });
}
GLOBAL.magicZoomPlus = () => {
    loadCSS(baseUrl + 'themes/magiczoomplus/magiczoomplus.css');
    loadScript(baseUrl + 'themes/magiczoomplus/magiczoomplus.js', function() {});
}
GLOBAL.slickDetail = () => {
    loadCSS(baseUrl + "themes/slick/slick.css");
    loadCSS(baseUrl + "themes/slick/slick-theme.css");
    loadScript(baseUrl + "themes/slick/slick.js", () => {

        var sliderCol4 = $('.slide-productCol4');

        var sliderCol5 = $('.slide-productCol5');

        var numbColumns;

        var numbRows;

        if (mobile == 'yes') {

            numbRows = 1;

            numbColumns = 2

        } else {

            numbRows = rows;

            numbColumns = column

        }
        var sliderCol = {
            'Element': $('.slide-productCol' + column),
            'autoplaySpeed': parseInt(autoplaySpeed),
            'autoplay': autoPlay,
            'arrows': arrows,
            'speed': parseInt(speed),
            'show': parseInt(numbColumns),
            'rows': parseInt(numbRows)
        };

        if (sliderCol4.length > 0) {
            sliderCol4.slick({
                vertical: !1,
                accessibility: 1,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 1000,
                arrows: true,
                dots: !1,
                draggable: true,
                pauseOnHover: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    }
                ]
            });
        }
        if (sliderCol5.length > 0) {
            sliderCol5.slick({
                vertical: !1,
                accessibility: 1,
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 1000,
                arrows: true,
                dots: !1,
                draggable: true,
                pauseOnHover: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    }
                ]
            });
        }
        if (sliderCol.Element.length > 0) {
            sliderCol.Element.slick({
                vertical: !1,
                accessibility: 1,
                slidesToShow: sliderCol.show,
                rows: sliderCol.rows,
                slidesToScroll: 1,
                autoplay: sliderCol.autoplay,
                autoplaySpeed: sliderCol.autoplaySpeed,
                speed: sliderCol.speed,
                arrows: sliderCol.arrows,
                dots: !1,
                draggable: true,
                pauseOnHover: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
        if ($('.slide-active').length > 0) {
            $('.slide-active').slick({
                vertical: !1,
                accessibility: 1,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 1000,
                arrows: true,
                dots: !1,
                draggable: true,
                pauseOnHover: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    }
                ]
            });
        }
        if ($('.slide-feedbacks').length > 0) {
            $('.slide-feedbacks').slick({
                vertical: !1,
                accessibility: 1,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 1000,
                arrows: true,
                dots: !1,
                draggable: true,
                pauseOnHover: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
        if ($('.slide-news').length > 0) {
            $('.slide-news').slick({
                vertical: true,
                accessibility: 1,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1000,
                speed: 2000,
                arrows: false,
                dots: !1,
                draggable: true,
                pauseOnHover: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
        if ($('.slickDoiTac').length > 0) {
            $('.slickDoiTac').slick({
                vertical: !1,
                accessibility: 1,
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                speed: 1000,
                arrows: true,
                centerMode: !1,
                dots: !1,
                draggable: 1,
                pauseOnHover: 1,
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        if ($('.slick-template').length > 0) {
            $('.slick-template').slick({
                vertical: !1,
                infinite: 1,
                accessibility: 1,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: !1,
                autoplaySpeed: 3000,
                speed: 1000,
                arrows: 1,
                centerMode: !1,
                dots: !1,
                draggable: 1,
                pauseOnHover: 1,
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }

        if ($('.slide-video').length > 0) {
            $('.slide-video').slick({
                vertical: false,
                accessibility: 1,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2500,
                speed: 1000,
                arrows: false,
                centerMode: !1,
                dots: !1,
                draggable: 1,
                pauseOnHover: 1,
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        if (template == 'thietke_detail') {
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
                slidesToShow: 8,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                arrows: false,
                autoplay: true,
                vertical: false,
                dots: false,
                centerMode: true,
                focusOnSelect: true,
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        if ($('.gallery-top').length > 0) {
            $('.gallery-top').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                adaptiveHeight: true,
                fade: true,
                autoplay: false, //Tự động chạy
                autoplaySpeed: 5000, //Tốc độ chạy
                asNavFor: '.gallery-bottom'
            });
            $('.gallery-bottom').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.gallery-top',
                dots: false,
                arrows: false,
                centerMode: false,
                focusOnSelect: true,
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 8,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    });
}
GLOBAL.addProfile = () => {
    $("#avatar").change(function() {
        readURL(this, '#img-view');
    });
}
GLOBAL.lazyloadImage = function() {

    loadScript(baseUrl + 'themes/js/appear.js', function() {

        setTimeout(function() {

            var i = $("[data-lazyload]");

            i.length > 0 && i.each(function() {

                var i = $(this),
                    e = i.attr("data-lazyload");

                i.appear(function() {

                    i.removeAttr("height").attr("src", e);

                }, {

                    accX: 0,

                    accY: 168

                }, "easeInCubic");

            });

            var e = $("[data-lazyload2]");

            e.length > 0 && e.each(function() {

                var i = $(this),
                    e = i.attr("data-lazyload2");

                i.appear(function() {

                    i.css("background-image", "url(" + e + ")");

                }, {

                    accX: 0,

                    accY: 168

                }, "easeInCubic");

            });

        }, 100);
    });

};
GLOBAL.sortChange = () => {
    $('select[name="js-sort-by"]').change(function() {
        var o = $(this);
        var s = o.val() || '';
        var k = $('#keywords').val() || '';
        var h = o.data('href') || '';
        var p = o.data('page') || 1;
        var l = o.data('show');
        var url = '';
        if (k != '') {
            url += '&keywords=' + k;
        }
        if (s != '') {
            url += '&sortby=' + s;
        }
        if (l != 0) {
            url += '&show=' + l;
        }
        if (p != 0) {
            url += '&page=' + p;
        }
        var href = $('input[name=href]').val();

        $('select[name="js-limit-by"]').attr('data-sort', s);

        pushState({
            sortby: s
        }, '', h + url);

        doSearch({
            'href': href,
            'alias': h,
            'keywords': k,
            'sortby': s,
            'show': l,
            'page': p
        });

    });

    $('select[name="js-limit-by"]').change(function() {
        var o = $(this);
        var s = o.val() || '';
        var k = $('#keywords').val() || '';
        var h = o.data('href') || '';
        var p = o.data('page') || 1;
        var l = o.data('sort');
        var url = '';
        if (k != '') {
            url += '&keywords=' + k;
        }
        if (l != 0) {
            url += '&sortby=' + l;
        }
        if (s != '') {
            url += '&show=' + s;
        }
        if (p != 0) {
            url += '&page=' + p;
        }
        var href = $('input[name=href]').val();

        $('select[name="js-sort-by"]').attr('data-show', s);

        pushState({
            show: s
        }, '', h + url);

        doSearch({
            'href': href,
            'alias': h,
            'keywords': k,
            'sortby': l,
            'show': s,
            'page': p
        });

    });

    $('.js-send-comment').click(function() {

        var _that = $(this);

        var rating = $('input[name=rating]:checked').val();

        var content = $('textarea[name=content-comment]').val();

        var userid = $('input[name=userid]').val();

        var productid = $('input[name=productid]').val();

        if (userid == '') {

            GLOBAL.showToastr('Bạn chưa đăng nhập để đánh giá sản phẩm này!', 'error');

            setTimeout(function() {

                $('a.popup-login:first').trigger('click');

            }, 1000);

            return false;

        }

        if (isBlank(content)) {

            GLOBAL.showToastr('Bạn chưa nhận ý kiến đánh giá!', 'error');

            $('textarea[name=content-comment]').focus();

            return false;

        }

        $.ajax({
            url: 'ajax/rating.php',
            type: 'POST',
            dataType: 'json',
            data: {
                rating: rating,
                content: content,
                id_user: userid,
                id_product: productid,
                type: 'comment'
            },
            beforeSend: function() {
                _that.addClass('loading');
            },
            success: function(data) {
                if (data.status == 200) {
                    setTimeout(function() {
                        _that.removeClass('loading');
                        GLOBAL.showToastr(data.message, 'success');
                        $('textarea[name=content-comment]').val('');
                    }, 2000);
                } else {
                    setTimeout(function() {
                        _that.removeClass('loading');
                        GLOBAL.showToastr(data.message, 'warning');
                    }, 2000);
                }
            }
        });
    });
}
GLOBAL.searchPage = () => {
    $('button.button-search').click(function() {
        var t = $('#keywords');
        searchEnter(t);
    });
    $('#keywords').keypress(function(e) {
        if (e.which == 13) {
            searchEnter($(this));
        }
    });
}
GLOBAL.localStore = () => {
    $('body').on('click', '.color-themes-page li', function(event) {
        var o = $(this);
        var v = o.attr('class');
        var c = o.attr('data-color');
        if (typeof(Storage) !== "undefined") {
            localStorage.setItem('v', v);
            localStorage.setItem('c', c);
            class_ = localStorage.getItem('v');
            color_ = localStorage.getItem('c');

            if (typeof chart_order !== "undefined") {
                window.setTimeout(function() {
                    chart_order.updateOptions({
                        colors: ['#' + color_]
                    });

                }, 100);
            }
            if (typeof apexMixedChart !== "undefined") {
                window.setTimeout(function() {
                    apexMixedChart.updateOptions({
                        colors: ['#' + color_]
                    });
                }, 100);
            }

            $('body').removeAttr('class').addClass('theme-' + class_);

        } else {
            console.log('Sorry! No Web Storage support.');
        }
    });
}
$window.load(() => {
    GLOBAL.niceSelect();
    GLOBAL.sortChange();
    GLOBAL.lazyloadImage();
    if (blocksite == "yes") {
        $body.addClass('noselect');
        GLOBAL.blockSite();
    }
    if (mobile == 'yes') {
        GLOBAL.numbClick();
        $numbClick.addClass('js-numbClass');
        GLOBAL.fixMenu();
    } else {
        GLOBAL.fixMenu();
    }
    GLOBAL.preLoader();
    if (template == 'thuvienanh_detail') {
        loadCSS(baseUrl + 'themes/lightgallery/css/lightgallery.css');
        loadScript(baseUrl + 'themes/lightgallery/js/lightgallery.min.js', function() {
            $lightGallery.lightGallery();
        });
    }
    if (template == 'products/product_detail') {
        GLOBAL.magicZoomPlus();
        GLOBAL.changeThumb();
    }
    if (toc_page == 1) {
        GLOBAL.tocList();
    }

    // class_ = localStorage.getItem('v');
    // $('body').removeAttr('class').addClass('theme-' + class_);

})
var _arr_script = {};
var loadScript = (scriptName, callback) => {
    if (!_arr_script[scriptName]) {
        _arr_script[scriptName] = 1;
        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.src = scriptName;
        script.onload = () => callback(null, script);
        script.onerror = () => callback(new Error(`Script load error for ${scriptName}`));
        body.appendChild(script);
    } else if (callback) {
        callback();
    }
};
var _arr_css = {};
var loadCSS = (cssName) => {
    if (!_arr_css[cssName]) {
        _arr_css[cssName] = 1;
        var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('link');
        script.type = 'text/css';
        script.rel = 'stylesheet';
        script.href = cssName;
        head.appendChild(script);
    }
};
GLOBAL.bootstrap();
GLOBAL.searchPage();
GLOBAL.marQuee();
GLOBAL.parsley();
GLOBAL.scrollText();
GLOBAL.newsletter();
GLOBAL.backToTop();
GLOBAL.clickMenu();
GLOBAL.slickDetail();
GLOBAL.Noti();
GLOBAL.fancyBox();
GLOBAL.photoBox();
GLOBAL.Swiper();
GLOBAL.Popup();
GLOBAL.counter();
GLOBAL.addProfile();
GLOBAL.dataTable();
