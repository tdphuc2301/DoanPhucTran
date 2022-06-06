<!DOCTYPE html>
<html lang="vi-VN">
@include('web.Layouts.header_detail_product')

<body>
@include('web.Layouts.banner-media')
@include('web.Layouts.menu-top')

<div class="bg-ellipse"></div>
<div class="locationbox__overlay"></div>

<?php $baseUrl = env('APP_URL') ?>
<section data-id="235838" data-cate-id="42" class="detail ">
    <ul class="breadcrumb">
        <li>
            <a href="#">{{$product['brand']['name']}}</a>
            <meta property="position" content="1">
        </li>
        <li>
            <span>›</span>
            <a href="#">Điện thoại {{$product['brand']['name']}}</a>
            <meta property="position" content="2">
        </li>
    </ul>


    <h1>{{$product['name']}}</h1>


    <div class="box02">
        <div class="box02__left">

            <div class="detail-rate">
                <p>
                    <i class="one-point icondetail-star"></i>
                    <i class="two-point icondetail-star"></i>
                    <i class="three-point icondetail-star"></i>
                    <i class="four-point icondetail-star-dark"></i>
                    <i class="five-point icondetail-star-dark"></i>
                </p>
                <p class="detail-rate-total">{{$product['total_rate']}}<span> đánh giá</span></p>
            </div>
        </div>
        <div class="box02__right">
            <i class="icondetail-sosanh"></i> So sánh
        </div>
    </div>

    <div class="like-fanpage" data-url="http://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra"></div>

    <div class="box_main">
        <div class="box_left">

            <div class="box01">
                <div class="box01__show">
                    <div class="show-tab loading">
                        <div class="detail-slider owl-carousel">
                            @foreach($product['images'] as $image)
                                <a class="slider-item ">
                                    <img class="owl-lazy" data-src="{{$baseUrl.'/'.$image['path']}}" width="710"
                                         height="394" alt="{{$product['name']}}" style="opacity:0;"/>
                                </a>
                            @endforeach
                        </div>
                        <div class="total-imgslider">
                            <a id="show-popup-featured-images-gallery" style="display: block" href="javascript:void(0)"
                               data-is-360-gallery="False" class="read-full" data-gallery-id="featured-images-gallery"
                               data-color-id="0">Xem t&#x1EA5;t c&#x1EA3; &#x111;i&#x1EC3;m n&#x1ED5;i b&#x1EAD;t</a>
                            <div class="counter"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="policy_intuitive cate42 scenarioNomal">
                <div class="policy">
                    <ul class="policy__list">
                        <div class="border7"></div>
                        <h1>Cấu hình</h1>
                        <div class="parameter" style="width: 100%">
                            <ul class="parameter__list 235838 active">
                                <li data-index="0" data-prop="0">
                                    <p class="lileft">Hãng điện thoại</p>
                                    <div class="liright">
                                        <span class="comma">{{$product['brand']['name']}}</span>
                                    </div>
                                </li>
                                <li data-index="0" data-prop="0">
                                    <p class="lileft">Bộ nhớ Ram</p>
                                    <div class="liright">
                                        <span class="">{{$product['ram']['name']}}</span>
                                    </div>
                                </li>

                                <li data-index="0" data-prop="0">
                                    <p class="lileft">Bộ nhớ trong</p>
                                    <div class="liright">
                                        <span class="comma">{{$product['ram']['name']}}</span>
                                    </div>
                                </li>

                                <li data-index="0" data-prop="0">
                                    <p class="lileft">Loại điện thoại</p>
                                    <div class="liright">
                                        <span class="">{{$product['category']['name']}}</span>
                                    </div>
                                </li>

                                <li data-index="0" data-prop="0">
                                    <p class="lileft">Mô tả</p>
                                    <div class="liright">
                                        <span class="comma" id="description_product"></span>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            let description_product = '<?php echo $product['description'] ?>';
            document.getElementById('description_product').innerHTML = description_product;
        </script>


        <div class="box_right">
            <div class="scrolling_inner">
                <div class="box03 color group desk">
                    <ul>
                    @foreach($product['colors'] as $key => $value)
                        @if($key === 0)
                            <li  class="box03__item item act color_name" color_name="{{$value['name']}}">{{$value['name']}}</li>
                        @else
                            <li  class="box03__item item color_name" color_name="{{$value['name']}}">{{$value['name']}}</li>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>


            <div class="box04 box_normal">

                <div class="box04__txt">
                    Gi&#xE1; t&#x1EA1;i <a href="javascript:;" onclick="OpenLocation()">H&#x1ED3; Ch&#xED; Minh</a>
                </div>


                <div class="price-one">
                    <div class="box-price">
                        <p class="box-price-present">{{$product['sale_off_price']}}₫</p>
                        <p class="box-price-old">{{$product['price']}}₫</p>

                        {{--                        <span class="label label--black">Trả góp 0%</span>--}}
                    </div>
                </div>
                <div class="block block-price1">


                    <div class="block__promo">
                        <div class="pr-top">
                            <p class="pr-txtb">Khuyến mãi giảm giá {{$promotions[1]['value']}} %</p>
                            <i class="pr-txt">Giá và khuyến mãi dự kiến áp dụng đến 23:00 {{$promotions[1]['created_at']}}</i>
                        </div>
                        <div class="pr-content">
                            <div class="pr-item">
                                @foreach($promotions as $promotion)
                                    <div class="divb t1" data-promotion="1044089" data-group="T&#x1EB7;ng"
                                         data-discount="2000000" data-productcode="DISCOUNT" data-tovalue="2000000">
                                        <span class="nb">{{$promotion['id']}}</span>
                                        <div class="divb-right">
                                            <p>{{$promotion['name']}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="block-button normal">
                                <form method="get" action="{{route('web.cart.get')}}" >
                                    @csrf
                                    <input type="hidden" name="color_id" >
                                    <input type="hidden" name="product_id" >
                                    <button  style="width: 100%"  type="submit" class="btn-buynow jsBuy">MUA NGAY</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        

        <div class="row">
            <div class="border7"></div>

            <div class="box-border">
                <div class="rating " id="danhgia">
                    <p class="rating__title">Đánh giá điện thoại Samsung Galaxy S22 Ultra 5G 128GB</p>
                    <div class="rating-star left">
                        <div class="rating-left">
                            <div class="rating-top">
                                <p class="point">{{$product['rate']}}</p>
                                <div class="list-star">
                                    <i class="icondetail-ratestar"></i>
                                    <i class="icondetail-ratestar"></i>
                                    <i class="icondetail-ratestar"></i>
                                    <i class="icondetail-darkstar"></i>
                                    <i class="icondetail-darkstar"></i>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="rating-img right">
                        <a href="" class="rating-total">Tổng công có {{$product['total_rate']}} đánh giá</a>
                    </div>
                </div>
                <div class="comment comment--all ratingLst">


                    <div class="comment__item par" id="r-51421172">
                        <div class="item-top">
                            <p class="txtname">Tr&#x1EA7;n T&#xF9;ng</p>

                            <p class="tickbuy">
                                <i class="icondetail-tickbuy"></i> &#x110;&#xE3; mua t&#x1EA1;i TGDD
                            </p>

                        </div>
                        <div class="item-rate">
                            <div class="comment-star">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star-dark"></i>
                                <i class="icon-star-dark"></i>
                            </div>


                        </div>

                        <div class="comment-content">
                            <p class="cmt-txt">Mới mua dùng dc 2 ngày, Pin tụt khá nhanh dù để chế độ tiết kiệm pin. Máy
                                nhạy, xử lý tác vụ nhanh.</p>
                        </div>


                        <div class="item-click">
                            <a href="javascript:likeRating(51421172);" class="click-like" data-like="0">
                                <i class="icondetail-likewhite"></i>
                                H&#x1EEF;u &#xED;ch
                            </a>

                            <a href="javascript:showRatingCmtChild('r-51421172')" class="click-cmt">
                                <i class="icondetail-comment"></i>
                                <span class="cmtr">Thảo luận</span>
                            </a>
                            <a href="javascript:void(0)" class="click-use">
                                &#x110;&#xE3; d&#xF9;ng kho&#x1EA3;ng 1 ng&#xE0;y
                                <i class="icondetail-question"></i>

                                <div class="info-buying">
                                    <div class="info-buying-close"></div>
                                    <div class="info-buying-txt">
                                        <div class="txtitem">
                                            <p class="txt01">Mua ngày </p>
                                            <p class="txtdate">10/05/2022</p>
                                        </div>
                                        <div class="txtitem">
                                            <p class="txt01">Viết đánh giá</p>
                                            <p class="txtdate">12/05/2022</p>
                                        </div>
                                    </div>
                                    <div class="length-using">
                                        <div class="length-percent" style="width: 70%;"></div>
                                    </div>
                                    <p class="timeline-txt">Đã dùng <span>kho&#x1EA3;ng 1 ng&#xE0;y</span></p>
                                    <ul class="info-buying-list">
                                        <li><span></span>Ở thời điểm viết đánh giá, khách đã mua sản phẩm kho&#x1EA3;ng
                                            1 ng&#xE0;y.
                                        </li>
                                        <li><span></span>Thời gian sử dụng thực tế có thể bằng hoặc ít hơn khoảng thời
                                            gian này.
                                        </li>
                                    </ul>
                                </div>

                            </a>

                            <div class="rr-51421172 reply hide">
                                <input placeholder="Nhập thảo luận của bạn"/>
                                <a href="javascript:ratingRelply(51421172);" class="rrSend">GỬI</a>
                                <div class="ifrl">
                                    <span>Khách</span> | <a href="javascript:rCmtEditName()">Nhập tên</a>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="comment__item rp-51421172 childC__item hide" id="r-51421222">
                        <div class="item-top">
                            <p class="txtname">Linh H&#xE2;n</p>

                            <span class="qtv">QTV</span>

                        </div>
                        <div class="item-rate">


                        </div>

                        <div class="comment-content">
                            <p class="cmt-txt">Chào anh,<br/>Dạ cám ơn mình đã quan tâm sử dụng và có đánh giá về sản
                                phẩm của Thế giới di động, mong mình sẽ có trải nghiệm tốt khi sử dụng sản phẩm lâu dài
                                ạ. Hân hạnh phục vụ và đồng hành cùng Quý khách ạ. <br/>Thông tin
                                đến anh.</p>
                        </div>


                        <div class="item-click">
                            <a href="javascript:likeRating(51421222);" class="click-like" data-like="0">
                                <i class="icondetail-likewhite"></i>
                                H&#x1EEF;u &#xED;ch
                            </a>


                            <div class="rr-51421222 reply hide">
                                <input placeholder="Nhập thảo luận của bạn"/>
                                <a href="javascript:ratingRelply(51421222);" class="rrSend">GỬI</a>
                                <div class="ifrl">
                                    <span>Khách</span> | <a href="javascript:rCmtEditName()">Nhập tên</a>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="comment__item par" id="r-51256571">
                        <div class="item-top">
                            <p class="txtname">Ph&#x1EA1;m ho&#xE0;i nam</p>

                            <p class="tickbuy">
                                <i class="icondetail-tickbuy"></i> &#x110;&#xE3; mua t&#x1EA1;i TGDD
                            </p>

                        </div>
                        <div class="item-rate">
                            <div class="comment-star">
                                <i class="icon-star"></i>
                                <i class="icon-star-dark"></i>
                                <i class="icon-star-dark"></i>
                                <i class="icon-star-dark"></i>
                                <i class="icon-star-dark"></i>
                            </div>


                        </div>

                        <div class="comment-content">
                            <p class="cmt-txt">Thật sự rất thất vọng và bức súc khi tôi mua dùng 10 ngày đã sãy ra lỗi
                                ko cho tôi đổi mới phải kêu tui gửi về hãng..đưa cho kiểm tra thì bấm bấm chẳng làm được
                                gì..kêu về dùng thì vẫn vậy...h qua tháng luôn rồi làm đc j nửa đáng
                                lên án</p>
                        </div>


                        <p class="support">
                            <i class="icondetail-logoyl"></i> Ch&#x103;m s&#xF3;c kh&#xE1;ch h&#xE0;ng &#x111;&#xE3; li&#xEA;n
                            h&#x1EC7; h&#x1ED7; tr&#x1EE3; ng&#xE0;y 26/04/2022
                        </p>

                        <div class="item-click">
                            <a href="javascript:likeRating(51256571);" class="click-like" data-like="0">
                                <i class="icondetail-likewhite"></i>
                                H&#x1EEF;u &#xED;ch
                            </a>

                            <a href="javascript:showRatingCmtChild('r-51256571')" class="click-cmt">
                                <i class="icondetail-comment"></i>
                                <span class="cmtr">Thảo luận</span>
                            </a>
                            <a href="javascript:void(0)" class="click-use">
                                &#x110;&#xE3; d&#xF9;ng kho&#x1EA3;ng 1 th&#xE1;ng
                                <i class="icondetail-question"></i>

                                <div class="info-buying">
                                    <div class="info-buying-close"></div>
                                    <div class="info-buying-txt">
                                        <div class="txtitem">
                                            <p class="txt01">Mua ngày </p>
                                            <p class="txtdate">04/03/2022</p>
                                        </div>
                                        <div class="txtitem">
                                            <p class="txt01">Viết đánh giá</p>
                                            <p class="txtdate">24/04/2022</p>
                                        </div>
                                    </div>
                                    <div class="length-using">
                                        <div class="length-percent" style="width: 70%;"></div>
                                    </div>
                                    <p class="timeline-txt">Đã dùng <span>kho&#x1EA3;ng 1 th&#xE1;ng</span></p>
                                    <ul class="info-buying-list">
                                        <li><span></span>Ở thời điểm viết đánh giá, khách đã mua sản phẩm kho&#x1EA3;ng
                                            1 th&#xE1;ng.
                                        </li>
                                        <li><span></span>Thời gian sử dụng thực tế có thể bằng hoặc ít hơn khoảng thời
                                            gian này.
                                        </li>
                                    </ul>
                                </div>

                            </a>
                            <div class="box-history">
                                <i class="icondetail-dots icon-dots"></i>
                                <p class="txt-dots" onclick="rtHis(51256571)">Xem lịch sử đánh giá</p>
                            </div>

                            <div class="rr-51256571 reply hide">
                                <input placeholder="Nhập thảo luận của bạn"/>
                                <a href="javascript:ratingRelply(51256571);" class="rrSend">GỬI</a>
                                <div class="ifrl">
                                    <span>Khách</span> | <a href="javascript:rCmtEditName()">Nhập tên</a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="comment-btn">

                    <a href="javascript:showInputRating();" class="comment-btn__item blue"><i
                                class="iconratingnew-circlestar--big"></i>Viết đánh giá</a>
                    <a href="/dtdd/samsung-galaxy-s22-ultra/danh-gia" class="comment-btn__item right-arrow"><span>Xem 26 đánh giá</span></a>
                </div>


                <div class="read-assess hide">
                    <form class="input frtip" name="fRatingComment">
                        <input type="hidden" name="hdfStar" id="hdfStar" value="0"/>
                        <input type="hidden" name="hdfRtIsMobile" id="hdfRtIsMobile" value="false"/>
                        <input type="hidden" name="hdfProductID" id="hdfProductID" value="235838"/>
                        <input type="hidden" name="hdfIsShare" id="hdfIsShare" value="0"/>
                        <input type="hidden" name="hdfSiteID" id="hdfSiteID" value="1"/>
                        <input type="hidden" name="hdfRtImg" id="hdfRtImg" class="hdfRtImg" value=""/>
                        <input type="hidden" name="hdfRtLink" id="hdfRtLink" value=""/>

                        <div class="read-assess__top">
                            <p class="read-assess__title">Đánh giá</p>
                            <div class="read-assess-close btn-closemenu" onclick="hideInputRating()">Đóng</div>
                        </div>

                        <div class="read-assess-main">

                            <div class="box-cmt-popup">
                                <div class="info-pro" data-brand="Samsung" data-price="30990000.0"
                                     data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB"
                                     data-id="235838" data-category="&#x110;i&#x1EC7;n tho&#x1EA1;i"
                                     data-is-production="True">
                                    <div class="img-cmt">
                                        <img data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg"
                                             class="lazyload"
                                             alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB">
                                    </div>
                                    <div class="text-pro">
                                        <h3>&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB</h3>
                                    </div>
                                </div>
                                <div class="select-star">
                                    <p class="txt01">Bạn cảm thấy sản phẩm này như thế nào? (chọn sao nhé):</p>
                                    <ul class="ul-star">
                                        <li data-val="1">
                                            <i class="iconratingnew-star--big"></i>
                                            <p>Rất tệ</p>
                                        </li>
                                        <li data-val="2">
                                            <i class="iconratingnew-star--big"></i>
                                            <p>Tệ</p>
                                        </li>
                                        <li data-val="3">
                                            <i class="iconratingnew-star--big"></i>
                                            <p>Bình thường</p>
                                        </li>
                                        <li data-val="4">
                                            <i class="iconratingnew-star--big"></i>
                                            <p>Tốt</p>
                                        </li>
                                        <li data-val="5">
                                            <i class="iconratingnew-star--big"></i>
                                            <p>Rất tốt</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="read-assess-form">
                                <div class="textarea">
                                    <textarea class="ct" name="fRContent"
                                              placeholder="Mời bạn chia sẻ thêm một số cảm nhận về sản phẩm ..."></textarea>
                                    <div class="textarea-bottom clearfix">
                                        <a href="javascript:void(0)" class="send-img">
                                            <i class="icondetail-camera"></i>
                                            Gửi hình chụp thực tế
                                        </a>
                                        <input id="hdFileRatingUpload" type="file" class="hide"
                                               accept="image/x-png, image/gif, image/jpeg"/>
                                        <ul class="resRtImg hide">
                                        </ul>
                                    </div>
                                </div>


                                <div class="txt-agree">
                                    <span></span>
                                    <p>Tôi sẽ giới thiệu sản phẩm này cho bạn bè người thân</p>
                                </div>

                                <div class="list-input">
                                    <input type="text" name="fRName" class="input-assess"
                                           placeholder="Họ và tên (bắt buộc)" value="">
                                    <input type="text" name="fRPhone" class="input-assess"
                                           placeholder="Số điện thoại (bắt buộc)" value="">
                                    <input type="text" name="fREmail" class="input-assess"
                                           placeholder="Email (không bắt buộc)" value="">

                                </div>


                                <a class="submit-assess" href="javascript:submitRatingComment()">Gửi đánh giá ngay</a>
                                <span class="lbMsgRt hide"></span>

                                <p class="assess-txtbt">Để đánh giá được duyệt, quý khách vui lòng tham khảo <a
                                            href="/huong-dan-dang-binh-luan">Quy định duyệt đánh giá</a></p>
                            </div>

                        </div>


                    </form>
                </div>

            </div>
        </div>

        <div class="clearfix"></div>
        <div class="container-productbox">
            <div id="preloader">
                <div id="loader"></div>
            </div>
            <h1>Các điện thoại liên quan</h1>
            <div id="datatable">
                @include('web.Pages.detail.datatable', [
                    'list' => $listOtherProduct,
                ])
            </div>

        </div>
    </div>

</section>


@include('web.Layouts.footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $("input[name='product_id']").val('<?php echo $product['id'] ?>');
    let colorNameInit = '<?php echo $product['colors'][0]['name'] ?>';
    $("input[name='color_id']").val(colorNameInit);
    $(document).delegate('.color_name ', 'click', function (e) {
        $('.color_name').removeClass('act');
        let color_name =$(this).attr("color_name");
        if( colorNameInit === color_name) {
            $(this).removeClass('act');
            
        } else {
            $(this).addClass('act');
        }
        colorNameInit = color_name;
        $("input[name='color_id']").val(color_name);
    });
</script>
<script src="//cdn.tgdd.vn/mwgcart/mwgcore/js/bundle/globalTGDD_V2.min.v202205040400.js"
        type="text/javascript"></script>
<script defer="defer" async="async"
        src="//cdn.tgdd.vn/mwgcart/mwgcore/js/bundle/detailTGDD.min.v202205130230.js"></script>

</body>

</html>