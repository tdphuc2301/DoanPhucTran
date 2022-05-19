<!DOCTYPE html>
<html lang="vi-VN">
@include('web.Layouts.header_detail_product')

<body>
@include('web.Layouts.banner-media')
@include('web.Layouts.menu-top')

<div class="bg-ellipse"></div>
<div class="locationbox__overlay"></div>
<div class="locationbox-v2">
    <div class="locationbox__item locationbox__item--right">
        <div class="top-location">
            <p class="default-title ">Quý khách vui lòng cho biết <b>Địa Chỉ Nhận Hàng</b> để biết chính xác thời gian giao hàng</p>
            <p class="full-location hide">
                <span class="choose-text">Địa chỉ đã chọn: </span>
                <span class="fulladdress-v2"></span>
            </p>
            <a onclick="OpenLocation()" class="cls-location" href="javascript:void(0)"><i class="close-symbol"></i>Đóng</a>
        </div>
        <div class="location-title hide">
            <a href="javascript:;" class="back-ic" onclick="backLocation()">
            </a>
            <div class="location-title-text">
                <span class="choose-text">Chọn </span>
                <span class="ward-name-default"></span>
                <span class="district-name-default"></span>
                <span class="province-name-default"></span>
            </div>
            <a onclick="OpenLocation()" class="cls-location" href="javascript:void(0)">
                <i class="close-symbol"></i>Đóng
            </a>
        </div>

        <div class="location-search">
            <i class="icon-search"></i>
            <input class="" onkeyup="suggestLocation(event);" id="locationSearch" name="locationSearch" placeholder="Tìm nhanh tỉnh thành, quận huyện, phường xã" />
            <a href="javascript:;" class="clear-searchbox" onclick="clearSearchBox()">
                <span class="box-relative">
                    <i class="close-symbol"></i>
                </span>
            </a>
        </div>
    </div>
    <strong class="choose-province">Hoặc chọn tỉnh, thành phố</strong>
    <div class="listing-location">
        <div id="suggest-location"></div>
        <div id="lst-prov">

            <div class="listing-locale">
                <ul>
                    <li>
                        <a class="" data-value="3" href="javascript:void(0)" onclick="changePoupProvinceV2(3, this)">
                            H&#x1ED3; Ch&#xED; Minh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="5" href="javascript:void(0)" onclick="changePoupProvinceV2(5, this)">
                            H&#xE0; N&#x1ED9;i
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="9" href="javascript:void(0)" onclick="changePoupProvinceV2(9, this)">
                            &#x110;&#xE0; N&#x1EB5;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="82" href="javascript:void(0)" onclick="changePoupProvinceV2(82, this)">
                            An Giang
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="102" href="javascript:void(0)" onclick="changePoupProvinceV2(102, this)">
                            B&#xE0; R&#x1ECB;a - V&#x169;ng T&#xE0;u
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="103" href="javascript:void(0)" onclick="changePoupProvinceV2(103, this)">
                            B&#x1EAF;c Giang
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="104" href="javascript:void(0)" onclick="changePoupProvinceV2(104, this)">
                            B&#x1EAF;c K&#x1EA1;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="105" href="javascript:void(0)" onclick="changePoupProvinceV2(105, this)">
                            B&#x1EA1;c Li&#xEA;u
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="106" href="javascript:void(0)" onclick="changePoupProvinceV2(106, this)">
                            B&#x1EAF;c Ninh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="107" href="javascript:void(0)" onclick="changePoupProvinceV2(107, this)">
                            B&#x1EBF;n Tre
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="108" href="javascript:void(0)" onclick="changePoupProvinceV2(108, this)">
                            B&#xEC;nh &#x110;&#x1ECB;nh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="109" href="javascript:void(0)" onclick="changePoupProvinceV2(109, this)">
                            B&#xEC;nh D&#x1B0;&#x1A1;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="110" href="javascript:void(0)" onclick="changePoupProvinceV2(110, this)">
                            B&#xEC;nh Ph&#x1B0;&#x1EDB;c
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="111" href="javascript:void(0)" onclick="changePoupProvinceV2(111, this)">
                            B&#xEC;nh Thu&#x1EAD;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="81" href="javascript:void(0)" onclick="changePoupProvinceV2(81, this)">
                            C&#xE0; Mau
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="7" href="javascript:void(0)" onclick="changePoupProvinceV2(7, this)">
                            C&#x1EA7;n Th&#x1A1;
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="112" href="javascript:void(0)" onclick="changePoupProvinceV2(112, this)">
                            Cao B&#x1EB1;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="6" href="javascript:void(0)" onclick="changePoupProvinceV2(6, this)">
                            &#x110;&#x1EAF;k L&#x1EAF;k
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="113" href="javascript:void(0)" onclick="changePoupProvinceV2(113, this)">
                            &#x110;&#x1EAF;k N&#xF4;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="114" href="javascript:void(0)" onclick="changePoupProvinceV2(114, this)">
                            &#x110;i&#x1EC7;n Bi&#xEA;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="8" href="javascript:void(0)" onclick="changePoupProvinceV2(8, this)">
                            &#x110;&#x1ED3;ng Nai
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="115" href="javascript:void(0)" onclick="changePoupProvinceV2(115, this)">
                            &#x110;&#x1ED3;ng Th&#xE1;p
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="116" href="javascript:void(0)" onclick="changePoupProvinceV2(116, this)">
                            Gia Lai
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="117" href="javascript:void(0)" onclick="changePoupProvinceV2(117, this)">
                            H&#xE0; Giang
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="118" href="javascript:void(0)" onclick="changePoupProvinceV2(118, this)">
                            H&#xE0; Nam
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="120" href="javascript:void(0)" onclick="changePoupProvinceV2(120, this)">
                            H&#xE0; T&#x129;nh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="121" href="javascript:void(0)" onclick="changePoupProvinceV2(121, this)">
                            H&#x1EA3;i D&#x1B0;&#x1A1;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="101" href="javascript:void(0)" onclick="changePoupProvinceV2(101, this)">
                            H&#x1EA3;i Ph&#xF2;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="122" href="javascript:void(0)" onclick="changePoupProvinceV2(122, this)">
                            H&#x1EAD;u Giang
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="123" href="javascript:void(0)" onclick="changePoupProvinceV2(123, this)">
                            H&#xF2;a B&#xEC;nh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="124" href="javascript:void(0)" onclick="changePoupProvinceV2(124, this)">
                            H&#x1B0;ng Y&#xEA;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="125" href="javascript:void(0)" onclick="changePoupProvinceV2(125, this)">
                            Kh&#xE1;nh H&#xF2;a
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="126" href="javascript:void(0)" onclick="changePoupProvinceV2(126, this)">
                            Ki&#xEA;n Giang
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="127" href="javascript:void(0)" onclick="changePoupProvinceV2(127, this)">
                            Kon Tum
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="128" href="javascript:void(0)" onclick="changePoupProvinceV2(128, this)">
                            Lai Ch&#xE2;u
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="129" href="javascript:void(0)" onclick="changePoupProvinceV2(129, this)">
                            L&#xE2;m &#x110;&#x1ED3;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="130" href="javascript:void(0)" onclick="changePoupProvinceV2(130, this)">
                            L&#x1EA1;ng S&#x1A1;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="131" href="javascript:void(0)" onclick="changePoupProvinceV2(131, this)">
                            L&#xE0;o Cai
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="132" href="javascript:void(0)" onclick="changePoupProvinceV2(132, this)">
                            Long An
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="133" href="javascript:void(0)" onclick="changePoupProvinceV2(133, this)">
                            Nam &#x110;&#x1ECB;nh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="134" href="javascript:void(0)" onclick="changePoupProvinceV2(134, this)">
                            Ngh&#x1EC7; An
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="135" href="javascript:void(0)" onclick="changePoupProvinceV2(135, this)">
                            Ninh B&#xEC;nh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="136" href="javascript:void(0)" onclick="changePoupProvinceV2(136, this)">
                            Ninh Thu&#x1EAD;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="137" href="javascript:void(0)" onclick="changePoupProvinceV2(137, this)">
                            Ph&#xFA; Th&#x1ECD;
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="138" href="javascript:void(0)" onclick="changePoupProvinceV2(138, this)">
                            Ph&#xFA; Y&#xEA;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="139" href="javascript:void(0)" onclick="changePoupProvinceV2(139, this)">
                            Qu&#x1EA3;ng B&#xEC;nh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="140" href="javascript:void(0)" onclick="changePoupProvinceV2(140, this)">
                            Qu&#x1EA3;ng Nam
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="141" href="javascript:void(0)" onclick="changePoupProvinceV2(141, this)">
                            Qu&#x1EA3;ng Ng&#xE3;i
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="142" href="javascript:void(0)" onclick="changePoupProvinceV2(142, this)">
                            Qu&#x1EA3;ng Ninh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="143" href="javascript:void(0)" onclick="changePoupProvinceV2(143, this)">
                            Qu&#x1EA3;ng Tr&#x1ECB;
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="144" href="javascript:void(0)" onclick="changePoupProvinceV2(144, this)">
                            S&#xF3;c Tr&#x103;ng
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="145" href="javascript:void(0)" onclick="changePoupProvinceV2(145, this)">
                            S&#x1A1;n La
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="146" href="javascript:void(0)" onclick="changePoupProvinceV2(146, this)">
                            T&#xE2;y Ninh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="147" href="javascript:void(0)" onclick="changePoupProvinceV2(147, this)">
                            Th&#xE1;i B&#xEC;nh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="148" href="javascript:void(0)" onclick="changePoupProvinceV2(148, this)">
                            Th&#xE1;i Nguy&#xEA;n
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="149" href="javascript:void(0)" onclick="changePoupProvinceV2(149, this)">
                            Thanh H&#xF3;a
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="150" href="javascript:void(0)" onclick="changePoupProvinceV2(150, this)">
                            Th&#x1EEB;a Thi&#xEA;n Hu&#x1EBF;
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="151" href="javascript:void(0)" onclick="changePoupProvinceV2(151, this)">
                            Ti&#x1EC1;n Giang
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="152" href="javascript:void(0)" onclick="changePoupProvinceV2(152, this)">
                            Tr&#xE0; Vinh
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="153" href="javascript:void(0)" onclick="changePoupProvinceV2(153, this)">
                            Tuy&#xEA;n Quang
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="154" href="javascript:void(0)" onclick="changePoupProvinceV2(154, this)">
                            V&#x129;nh Long
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="155" href="javascript:void(0)" onclick="changePoupProvinceV2(155, this)">
                            V&#x129;nh Ph&#xFA;c
                        </a>
                    </li>
                    <li>
                        <a class="" data-value="156" href="javascript:void(0)" onclick="changePoupProvinceV2(156, this)">
                            Y&#xEA;n B&#xE1;i
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="lst-dis" class="hide">
        </div>
        <div id="lst-ward" class="hide">
        </div>
    </div>
    <input type="hidden" id="hdLocationProvinceId" value="0">
    <input type="hidden" id="hdLocationDisId" value="0">
    <input type="hidden" id="hdLocationWardId" value="0">
    <input type="hidden" id="hdLocationAddress" value="">
    <b id="h-provincename" style="display:none!important" data-provinceid="0"></b>
</div>
<div class="locationbox__popup new-popup hide" id="lc_pop--sugg">
    <div class="locationbox__popup--cnt locationbox__popup--suggestion new-locale">
        <div class="flex-block">
            <i class="icon-location"></i>
            <p>Hãy chọn <b>địa chỉ cụ thể</b> để chúng tôi cung cấp <b>chính xác</b> gi&#xE1; v&#xE0; khuy&#x1EBF;n m&#xE3;i</p>
        </div>
        <div class="btn-block">
            <a href="javascript:;" class="btn-location" onclick="OpenLocation()"><b>Chọn địa chỉ</b></a>
            <a href="javascript:;" class="btn-location gray" onclick="SkipLocation()"><b>Đóng</b></a>
        </div>
    </div>
</div>













<section data-id="235838" data-cate-id="42" class="detail ">
    <ul class="breadcrumb">
        <li>
            <a href="/dtdd">&#x110;i&#x1EC7;n tho&#x1EA1;i</a>
            <meta property="position" content="1">
        </li>
        <li>
            <span>›</span>
            <a href="/dtdd-samsung">&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung</a>
            <meta property="position" content="2">
        </li>
    </ul>


    <h1>&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB</h1>


    <div class="box02">
        <div class="box02__left">

            <div class="detail-rate">
                <p>
                    <i class="icondetail-star"></i>
                    <i class="icondetail-star"></i>
                    <i class="icondetail-star"></i>
                    <i class="icondetail-star-dark"></i>
                    <i class="icondetail-star-dark"></i>
                </p>
                <p class="detail-rate-total">26 <span>đánh giá</span></p>
            </div>
        </div>
        <div class="box02__right" data-id="235838" data-href="/dtdd/samsung-galaxy-s22-ultra" data-img="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB">
            <i class="icondetail-sosanh"></i> So sánh
        </div>
    </div>




    <div class="like-fanpage" data-url="http://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra"></div>

    <div class="box_main">
        <div class="box_left">

            <div class="box01">
                <div class="box01__show">
                    <div class="show-tab loading" data-gallery-id="featured-images-gallery" data-color-id="0">
                        <div class="detail-slider owl-carousel">
                            <a href="javascript:void(0)" class="slider-item video-item" data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="216977" data-video-id="XQMh9vPKTpg" data-index="0" data-time="0">
                                <img src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/samsung-galaxys22ultra5Gthumbvideo-1020x570.jpg" alt="Samsung Galaxy S22 Ultra 5G 128GB" width="710" height="394" />
                                <i class="icondetail-videoop iconvideo"></i>


                            </a>
                            <a href="javascript:void(0)" class="slider-item " data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="217066" data-video-id="" data-index="1" data-time="0">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/SamsungGalaxyS22ultraRAM8GBfixhz-1020x570.jpg" width="710" height="394" alt="Samsung Galaxy S22 Ultra 5G 128GB" style="opacity:0;" />


                            </a>
                            <a href="javascript:void(0)" class="slider-item " data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="217067" data-video-id="" data-index="2" data-time="0">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/2.ButSpen-1020x570.jpg" width="710" height="394" alt="Samsung Galaxy S22 Ultra 5G 128GB" style="opacity:0;" />


                            </a>
                            <a href="javascript:void(0)" class="slider-item " data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="217068" data-video-id="" data-index="3" data-time="0">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/3.Trainghiemthigiac-1020x570.jpg" width="710" height="394" alt="Samsung Galaxy S22 Ultra 5G 128GB" style="opacity:0;" />


                            </a>
                            <a href="javascript:void(0)" class="slider-item " data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="217069" data-video-id="" data-index="4" data-time="0">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/4.Vixulimanhme-1020x570.jpg" width="710" height="394" alt="Samsung Galaxy S22 Ultra 5G 128GB" style="opacity:0;" />


                            </a>
                            <a href="javascript:void(0)" class="slider-item " data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="217070" data-video-id="" data-index="5" data-time="0">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/5.Thietkebenbi-1020x570.jpg" width="710" height="394" alt="Samsung Galaxy S22 Ultra 5G 128GB" style="opacity:0;" />


                            </a>
                            <a href="javascript:void(0)" class="slider-item " data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="217073" data-video-id="" data-index="6" data-time="0">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/8.Matthanbongdem-1020x570.jpg" width="710" height="394" alt="Samsung Galaxy S22 Ultra 5G 128GB" style="opacity:0;" />


                            </a>
                            <a href="javascript:void(0)" class="slider-item " data-gallery-id="featured-images-gallery" data-color-id="0" data-picture-id="217071" data-video-id="" data-index="7" data-time="0">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Slider/6.Dungluongpin-1020x570.jpg" width="710" height="394" alt="Samsung Galaxy S22 Ultra 5G 128GB" style="opacity:0;" />


                            </a>


                            <a href="javascript:void(0)" class="slider-item slider-policy" data-gallery-id="featured-images-gallery" data-color-id="0" data-index="8">
                                <img class="owl-lazy" data-src="//cdn.tgdd.vn/mwgcart/mwgcore/ContentMwg/images/bg_csmh_tgdd-min.png?v=11" width="710" height="394" alt="Chính sách đổi trả" style="opacity:0;" />
                                <img class="si-ghtn hide" data-src="//cdn.tgdd.vn/mwgcart/mwgcore/ContentMwg/images/img_giaohang_tgdd-min.png" alt="Giao hàng tận nhà nhanh chóng">
                                <div></div>
                            </a>

                        </div>
                        <div class="total-imgslider">
                            <a id="show-popup-featured-images-gallery" style="display: block" href="javascript:void(0)" data-is-360-gallery="False" class="read-full" data-gallery-id="featured-images-gallery" data-color-id="0">Xem t&#x1EA5;t c&#x1EA3; &#x111;i&#x1EC3;m n&#x1ED5;i b&#x1EAD;t</a>
                            <div class="counter"></div>
                        </div>
                    </div>

                </div>
                <div class="scrolling_inner">
                    <div class="box01__tab scrolling">
                        <div id="thumb-featured-images-gallery-0" class="item itemTab active " data-gallery-id="featured-images-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
                            <div class="item-border">
                                <i class="icondetail-noibat"></i>
                            </div>
                            <p>&#x110;i&#x1EC3;m n&#x1ED5;i b&#x1EAD;t</p>
                        </div>
                        <div id="thumb-color-images-gallery-2" class="item itemTab  " data-gallery-id="color-images-gallery" data-color-id="2" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
                            <div class="item-border">
                                <img data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-200x200.jpg" alt="&#x110;&#x1ECF;" width="41" height="41" loading="lazy" class="lazyload" />
                            </div>
                            <p>&#x110;&#x1ECF;</p>
                        </div>
                        <div id="thumb-color-images-gallery-12" class="item itemTab  " data-gallery-id="color-images-gallery" data-color-id="12" data-is-full-spec="False" data-color-order-id="1" data-isfeatureimage="True">
                            <div class="item-border">
                                <img data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-White-200x200.jpg" alt="Tr&#x1EAF;ng" width="41" height="41" loading="lazy" class="lazyload" />
                            </div>
                            <p>Tr&#x1EAF;ng</p>
                        </div>
                        <div id="thumb-color-images-gallery-11" class="item itemTab  " data-gallery-id="color-images-gallery" data-color-id="11" data-is-full-spec="False" data-color-order-id="3" data-isfeatureimage="True">
                            <div class="item-border">
                                <img data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Black-200x200.jpg" alt="&#x110;en" width="41" height="41" loading="lazy" class="lazyload" />
                            </div>
                            <p>&#x110;en</p>
                        </div>
                        <div id="thumb-color-images-gallery-7" class="item itemTab  " data-gallery-id="color-images-gallery" data-color-id="7" data-is-full-spec="False" data-color-order-id="4" data-isfeatureimage="True">
                            <div class="item-border">
                                <img data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Green-200x200.jpg" alt="Xanh l&#xE1;" width="41" height="41" loading="lazy" class="lazyload" />
                            </div>
                            <p>Xanh l&#xE1;</p>
                        </div>
                        <div id="thumb-unbox-gallery-0" class="item itemTab  is-show-popup" data-gallery-id="unbox-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
                            <div class="item-border">
                                <i class="icondetail-box"></i>
                            </div>
                            <p>H&#xEC;nh m&#x1EDF; h&#x1ED9;p</p>
                        </div>
                        <div id="thumb-camera-image-gallery-0" class="item itemTab  " data-gallery-id="camera-image-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
                            <div class="item-border">
                                <i class="icondetail-graycamera"></i>
                            </div>
                            <p>Ch&#x1EE5;p t&#x1EEB; camera</p>
                        </div>
                        <div id="thumb-360-degree-gallery-0" class="item itemTab  is-show-popup" data-gallery-id="360-degree-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
                            <div class="item-border">
                                <i class="icondetail-360do"></i>
                            </div>
                            <p>H&#xEC;nh 360 &#x111;&#x1ED9;</p>
                        </div>
                        <div id="thumb-specification-gallery-0" class="item itemTab  is-show-popup" data-gallery-id="specification-gallery" data-color-id="0" data-is-full-spec="True" data-color-order-id="0" data-isfeatureimage="True">
                            <div class="item-border">
                                <i class="icondetail-thongso"></i>
                            </div>
                            <p>Th&#xF4;ng s&#x1ED1; k&#x1EF9; thu&#x1EAD;t</p>
                        </div>
                        <div id="thumb-article-gallery-0" class="item itemTab  is-show-popup" data-gallery-id="article-gallery" data-color-id="0" data-is-full-spec="False" data-color-order-id="0" data-isfeatureimage="True">
                            <div class="item-border">
                                <i class="icondetail-danhgia"></i>
                            </div>
                            <p>Th&#xF4;ng tin s&#x1EA3;n ph&#x1EA9;m</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-tab">
                <div class="bt-overlay"></div>
                <ul class="block-tab-top">
                    <li id="tab-featured-images-gallery-0" class="tab-item active" data-is-360-gallery="False" data-gallery-id="featured-images-gallery" data-color-id="0" data-thump-name="&#x110;i&#x1EC3;m n&#x1ED5;i b&#x1EAD;t">
                        &#x110;i&#x1EC3;m n&#x1ED5;i b&#x1EAD;t
                    </li>
                    <li id="tab-color-images-gallery-2" class="tab-item " data-is-360-gallery="False" data-gallery-id="color-images-gallery" data-color-id="2" data-thump-name="&#x110;&#x1ECF;">
                        &#x110;&#x1ECF;
                    </li>
                    <li id="tab-color-images-gallery-12" class="tab-item " data-is-360-gallery="False" data-gallery-id="color-images-gallery" data-color-id="12" data-thump-name="Tr&#x1EAF;ng">
                        Tr&#x1EAF;ng
                    </li>
                    <li id="tab-color-images-gallery-11" class="tab-item " data-is-360-gallery="False" data-gallery-id="color-images-gallery" data-color-id="11" data-thump-name="&#x110;en">
                        &#x110;en
                    </li>
                    <li id="tab-color-images-gallery-7" class="tab-item " data-is-360-gallery="False" data-gallery-id="color-images-gallery" data-color-id="7" data-thump-name="Xanh l&#xE1;">
                        Xanh l&#xE1;
                    </li>
                    <li id="tab-unbox-gallery-0" class="tab-item " data-is-360-gallery="False" data-gallery-id="unbox-gallery" data-color-id="0" data-thump-name="H&#xEC;nh m&#x1EDF; h&#x1ED9;p">
                        H&#xEC;nh m&#x1EDF; h&#x1ED9;p
                    </li>
                    <li id="tab-camera-image-gallery-0" class="tab-item " data-is-360-gallery="False" data-gallery-id="camera-image-gallery" data-color-id="0" data-thump-name="Ch&#x1EE5;p t&#x1EEB; camera">
                        Ch&#x1EE5;p t&#x1EEB; camera
                    </li>
                    <li id="tab-360-degree-gallery-0" class="tab-item " data-is-360-gallery="True" data-gallery-id="360-degree-gallery" data-color-id="0" data-thump-name="H&#xEC;nh 360 &#x111;&#x1ED9;">
                        H&#xEC;nh 360 &#x111;&#x1ED9;
                    </li>
                    <li id="tab-specification-gallery-0" class="tab-item " data-is-360-gallery="False" data-gallery-id="specification-gallery" data-color-id="0" data-thump-name="Th&#xF4;ng s&#x1ED1; k&#x1EF9; thu&#x1EAD;t">
                        Th&#xF4;ng s&#x1ED1; k&#x1EF9; thu&#x1EAD;t
                    </li>
                    <li id="tab-article-gallery-0" class="tab-item " data-is-360-gallery="False" data-gallery-id="article-gallery" data-color-id="0" data-thump-name="Th&#xF4;ng tin s&#x1EA3;n ph&#x1EA9;m">
                        Th&#xF4;ng tin s&#x1EA3;n ph&#x1EA9;m
                    </li>
                </ul>
                <div class="btn-closemenu close-tab">Đóng</div>
                <div class="block-tab-content">
                    <div class="content-t active not-load-content" id="tab-content-featured-images-gallery-0">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-color-images-gallery-2">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-color-images-gallery-12">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-color-images-gallery-11">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-color-images-gallery-7">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-unbox-gallery-0">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-camera-image-gallery-0">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-360-degree-gallery-0">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-specification-gallery-0">
                    </div>
                    <div class="content-t  not-load-content" id="tab-content-article-gallery-0">
                    </div>
                </div>
            </div>
            <div class="popup-overlay">
                <div class="popup-overlay__popup-video-gallery">
                    <div class="close-popup"><i></i></div>
                    <div id="video-player"></div>
                </div>
            </div>
            <span style="display: none;" id="show-popup-unbox-gallery" data-is-360-gallery="false" class="read-full" data-gallery-id="unbox-gallery" data-color-id="0"></span>
            <span style="display: none;" id="show-popup-360-degree-gallery" data-is-360-gallery="true" class="read-full" data-gallery-id="360-degree-gallery" data-color-id="0"></span>
            <span style="display: none;" id="show-popup-specification-gallery" data-is-360-gallery="false" class="read-full" data-gallery-id="specification-gallery" data-color-id="0"></span>
            <span style="display: none;" id="show-popup-article-gallery" data-is-360-gallery="false" data-is-article-gallery="true" class="read-full" data-gallery-id="article-gallery" data-color-id="0"></span>
            <div class="popup-video-rating">
                <div class="popup-video-rating__content active">
                    <b class="popup-video-rating__content__title">Video có hữu ích cho việc mua hàng của bạn không?</b>
                    <span class="popup-video-rating__content_like-container popup-video-rating__content__action"><i class="iconvideorating-likeGlr"></i>Hữu ích</span>
                    <span class="popup-video-rating__content_dislike-container popup-video-rating__content__action"><i class="iconvideorating-unlikeGlr"></i>Không hữu ích</span>
                </div>
                <b class="popup-video-rating__thank-you">Cảm ơn bạn đã đánh giá video</b>
            </div>

            <div class="manu-info-popup">
                <div class="manu-info-popup__content">
                    <span class="manu-info-popup__content__btn-close"></span>
                    <p class="manu-info-popup__content__title">
                        Giới thiệu về hãng
                        <img width="70" height="30" data-src="//cdn.tgdd.vn/Brand/1/samsungnew-220x48-1.png" alt="Samsung" class="lazyload" />
                    </p>
                    <div class="manu-info-popup__content__desc">
                        <p>(Hàn Quốc)</p>
                    </div>
                </div>
            </div>

            <script>
                setTimeout(function() {
                    var tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    var firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                }, 100);
            </script>



            <div class="policy_intuitive cate42 scenarioNomal">
                <div class="policy">
                    <ul class="policy__list">
                        <li>
                            <div class="iconl">
                                <i class="icondetail-doimoi"></i>
                            </div>
                            <p>
                                Hư gì đổi nấy <b>12 tháng</b> tại 3133 siêu thị toàn quốc (miễn phí tháng đầu) <a href="https://www.thegioididong.com/chinh-sach-bao-hanh-san-pham"></a>
                                <a href="javascript:;" onclick="showPopupPolicy()" title="Chính sách đổi trả">
                                    Xem chi tiết
                                </a>
                            </p>
                        </li>
                        <li data-field="IsSameBHAndDT">
                            <div class="iconl">
                                <i class="icondetail-baohanh"></i>
                            </div>
                            <p>
                                Bảo hành <b>chính hãng điện thoại 1 năm</b> tại các trung tâm bảo hành hãng
                                <a href="/bao-hanh/samsung" target="_blank" title="Chính sách bảo hành">
                                    Xem địa chỉ bảo hành
                                </a>

                            </p>
                        </li>

                        <li>
                            <div class="iconl"><i class="icondetail-sachhd"></i></div>
                            <p>Bộ sản phẩm gồm: Hộp, Sách hướng dẫn, Bút cảm ứng, Cây lấy sim, Cáp Type C <a href='javascript:' class='hinh-mo-hop-link'>Xem hình</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="wrap_wrtp dmx-popup" id="popup-baohanh">
                <div class="pop">
                    <div class="hdpop dmx">
                        CH&#xCD;NH S&#xC1;CH B&#x1EA2;O H&#xC0;NH, &#x110;&#x1ED4;I TR&#x1EA2;
                        <a href="javascript:closePopWrt()" class="closehd">
                            <span>✖</span>
                        </a>
                    </div>
                    <div id="popup-baohanh-content" class="overscroll">
                        <div class="warranty-box">
                            <h2 class="title">BẢO HÀNH CHÍNH HÃNG</h2>
                            <span>
                            Thân máy 1 năm, pin 1 năm, sạc 6 tháng
                        </span>
                            <p><a target="_blank" href="/bao-hanh/samsung">Xem điểm bảo hành Samsung</a></p>
                        </div>
                        <div class="change-box">
                            <h2 class="title">Chính sách đổi trả <span>Chỉ cần số điện thoại mua hàng, không cần giấy tờ.</span></h2>
                            <div class="block-change">

                                <h3 class="down" onclick="toggleBlock(this)">L&#x1ED7;i do nh&#xE0; s&#x1EA3;n xu&#x1EA5;t, Kh&#xE1;ch h&#xE0;ng ch&#x1ECD;n 1 trong 3 h&#xEC;nh th&#x1EE9;c</h3>
                                <div class="content-insider show">
                                    <div>
                                        <p><strong>Bảo hành có cam kết trong 12 tháng (chỉ áp dụng cho sản phẩm chính, KHÔNG áp dụng cho phụ kiện kèm theo)</strong></p>
                                        <ul>
                                            <li>Bảo hành trong vòng 15 ngày (từ lúc Khách hàng mang sản phẩm đến bảo hành đến lúc nhận lại sản phẩm tối đa 15 ngày).</li>
                                            <li>Sản phẩm không bảo hành lại lần 2 trong 30 ngày kể từ ngày máy được bảo hành xong.</li>
                                            <li>Nếu TGDD/ĐMX vi phạm cam kết (bảo hành quá 15 ngày hoặc phải bảo hành lại sản phẩm lần nữa trong 30 ngày kể từ lần bảo hành trước), Khách hàng được áp dụng phương thức <strong>Hư gì đổi nấy ngay và luôn</strong> hoặc <strong>Hoàn tiền</strong> với
                                                mức phí giảm 50%.</li>
                                            <li>Từ tháng thứ 13 trở đi, không áp dụng bảo hành có cam kết, chỉ áp dụng bảo hành hãng nếu có.</li>
                                        </ul>
                                        <p><strong>Hư gì đổi nấy ngay & luôn</strong></p>
                                        <ul>
                                            <li>Hư sản phẩm chính: Đổi sản phẩm mới (cùng model, cùng dung lượng, cùng màu sắc) miễn phí tháng đầu tiên, tháng thứ 2 đến tháng 12 chịu phí 10% hoá đơn/tháng. Nếu sản phẩm chính hết hàng thì áp dụng <strong>Bảo hành có cam kết</strong> hoặc <strong>Hoàn tiền</strong> với
                                                mức phí giảm 50%.</li>
                                            <li>Hư phụ kiện đi kèm: Đổi miễn phí trong vòng 12 tháng kể từ ngày mua sản phẩm chính bằng hàng phụ kiện TGDĐ/ĐMX đang kinh doanh mới với công năng tương đương. Nếu không có phụ kiện tương đương hoặc Khách
                                                hàng không thích thì áp dụng bảo hành hãng</li>
                                            <li>Lỗi phần mềm không áp dụng, mà chỉ khắc phục lỗi phần mềm.</li>
                                            <li>Trường hợp Khách hàng muốn đổi full box (nguyên thùng, nguyên hộp): ngoài việc áp dụng mức phí đổi trả thì Khách hàng sẽ trả thêm phí lấy full box tương đương 20% giá trị hóa đơn.</li>
                                        </ul>
                                        <p><strong>Hoàn tiền</strong></p>
                                        <ul>
                                            <li>Tháng đầu tiên kể từ ngày mua: phí 20% giá trị hóa đơn.</li>
                                            <li>Tháng thứ 2 đến tháng thứ 12: phí 10% giá trị hóa đơn/tháng.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="block-change">

                                <h3 class="" onclick="toggleBlock(this)">S&#x1EA3;n ph&#x1EA9;m kh&#xF4;ng l&#x1ED7;i</h3>
                                <div class="content-insider ">
                                    <div>
                                        <p><strong>Khách hàng có thể trả hàng hoàn tiền:</strong></p>
                                        <ul>
                                            <li>Tháng đầu tiên kể từ ngày mua: phí 20% giá trị hóa đơn.</li>
                                            <li>Tháng thứ 2 đến tháng thứ 12: phí 10% giá trị hóa đơn/tháng.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="block-change">

                                <h3 class="" onclick="toggleBlock(this)">S&#x1EA3;n ph&#x1EA9;m l&#x1ED7;i do ng&#x1B0;&#x1EDD;i d&#xF9;ng</h3>
                                <div class="content-insider ">
                                    <div>
                                        <p>Không bảo hành, đổi trả. TGDD/ĐMX hỗ trợ gửi hãng bảo hành, Khách hàng trả phí sửa chữa.</p>
                                    </div>
                                </div>
                            </div>
                            <p class="view-full">
                                Xem đầy đủ: <a href="https://www.thegioididong.com/chinh-sach-bao-hanh-san-pham" target="_blank">Chính sách bảo hành đổi trả</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="wrap_wrtp hide" id="popup-materialsfee">
                <div class="pop">

                </div>
            </div>


            <div class="box-available"></div>
            <div class="border7"></div>




            <div class="box_oldproduct">
                <a href="/may-doi-tra/dtdd/samsung-galaxy-s22-ultra?pid=235838&amp;prv=3" title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB">Xem &#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB cũ giá dưới <b>25.770.000&#x20AB;</b> <i>Tiết kiệm <b>16%</b></i></a>
            </div>






            <div class="img-main">
                <img class="lazyload" data-src="//cdn.tgdd.vn/Products/Images/42/235838/Kit/samsung-galaxy-s22-ultra-note.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB">
            </div>

            <div class="border7"></div>

            <div class="box-border">
                <div class="rating " id="danhgia">
                    <p class="rating__title">&#x110;&#xE1;nh gi&#xE1; &#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB</p>

                    <div class="rating-star left">
                        <div class="rating-left">
                            <div class="rating-top">
                                <p class="point">3</p>
                                <div class="list-star">
                                    <i class="icondetail-ratestar"></i>
                                    <i class="icondetail-ratestar"></i>
                                    <i class="icondetail-ratestar"></i>
                                    <i class="icondetail-darkstar"></i>
                                    <i class="icondetail-darkstar"></i>
                                </div>
                                <a href="/dtdd/samsung-galaxy-s22-ultra/danh-gia" class="rating-total">26 đánh giá</a>

                            </div>
                            <ul class="rating-list">
                                <li>
                                    <div class="number-star">
                                        5
                                        <i class="icondetail-blackstar"></i>
                                    </div>
                                    <div class="timeline-star">
                                        <p class="timing" style="width: 50%"></p>
                                    </div>
                                    <a href="/dtdd/samsung-galaxy-s22-ultra/danh-gia?s=5&p=1" class="number-percent">50%</a>
                                </li>
                                <li>
                                    <div class="number-star">
                                        4
                                        <i class="icondetail-blackstar"></i>
                                    </div>
                                    <div class="timeline-star">
                                        <p class="timing" style="width: 0%"></p>
                                    </div>
                                    <p class="number-percent dsp">0%</p>
                                </li>
                                <li>
                                    <div class="number-star">
                                        3
                                        <i class="icondetail-blackstar"></i>
                                    </div>
                                    <div class="timeline-star">
                                        <p class="timing" style="width: 27%"></p>
                                    </div>
                                    <a href="/dtdd/samsung-galaxy-s22-ultra/danh-gia?s=3&p=1" class="number-percent">27%</a>
                                </li>
                                <li>
                                    <div class="number-star">
                                        2
                                        <i class="icondetail-blackstar"></i>
                                    </div>
                                    <div class="timeline-star">
                                        <p class="timing" style="width: 4%"></p>
                                    </div>
                                    <a href="/dtdd/samsung-galaxy-s22-ultra/danh-gia?s=2&p=1" class="number-percent">4%</a>
                                </li>
                                <li>
                                    <div class="number-star">
                                        1
                                        <i class="icondetail-blackstar"></i>
                                    </div>
                                    <div class="timeline-star">
                                        <p class="timing" style="width: 19%"></p>
                                    </div>
                                    <a href="/dtdd/samsung-galaxy-s22-ultra/danh-gia?s=1&p=1" class="number-percent">19%</a>
                                </li>
                            </ul>


                        </div>

                    </div>

                    <div class="rating-img right">
                        <ul class="rating-img-list">
                            <li class="js-Showcmt" data-idx="1" onclick="goToRSlide(1)">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/comment/51043533/received_510390607157257284X1.jpeg" alt="">
                            </li>

                        </ul>
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
                            <p class="cmt-txt">Mới mua dùng dc 2 ngày, Pin tụt khá nhanh dù để chế độ tiết kiệm pin. Máy nhạy, xử lý tác vụ nhanh.</p>
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
                                        <li><span></span>Ở thời điểm viết đánh giá, khách đã mua sản phẩm kho&#x1EA3;ng 1 ng&#xE0;y.</li>
                                        <li><span></span>Thời gian sử dụng thực tế có thể bằng hoặc ít hơn khoảng thời gian này.</li>
                                    </ul>
                                </div>

                            </a>

                            <div class="rr-51421172 reply hide">
                                <input placeholder="Nhập thảo luận của bạn" />
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
                            <p class="cmt-txt">Chào anh,<br />Dạ cám ơn mình đã quan tâm sử dụng và có đánh giá về sản phẩm của Thế giới di động, mong mình sẽ có trải nghiệm tốt khi sử dụng sản phẩm lâu dài ạ. Hân hạnh phục vụ và đồng hành cùng Quý khách ạ. <br />Thông tin
                                đến anh.</p>
                        </div>




                        <div class="item-click">
                            <a href="javascript:likeRating(51421222);" class="click-like" data-like="0">
                                <i class="icondetail-likewhite"></i>
                                H&#x1EEF;u &#xED;ch
                            </a>


                            <div class="rr-51421222 reply hide">
                                <input placeholder="Nhập thảo luận của bạn" />
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
                            <p class="cmt-txt">Thật sự rất thất vọng và bức súc khi tôi mua dùng 10 ngày đã sãy ra lỗi ko cho tôi đổi mới phải kêu tui gửi về hãng..đưa cho kiểm tra thì bấm bấm chẳng làm được gì..kêu về dùng thì vẫn vậy...h qua tháng luôn rồi làm đc j nửa đáng
                                lên án</p>
                        </div>



                        <p class="support">
                            <i class="icondetail-logoyl"></i> Ch&#x103;m s&#xF3;c kh&#xE1;ch h&#xE0;ng &#x111;&#xE3; li&#xEA;n h&#x1EC7; h&#x1ED7; tr&#x1EE3; ng&#xE0;y 26/04/2022
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
                                        <li><span></span>Ở thời điểm viết đánh giá, khách đã mua sản phẩm kho&#x1EA3;ng 1 th&#xE1;ng.</li>
                                        <li><span></span>Thời gian sử dụng thực tế có thể bằng hoặc ít hơn khoảng thời gian này.</li>
                                    </ul>
                                </div>

                            </a>
                            <div class="box-history">
                                <i class="icondetail-dots icon-dots"></i>
                                <p class="txt-dots" onclick="rtHis(51256571)">Xem lịch sử đánh giá</p>
                            </div>

                            <div class="rr-51256571 reply hide">
                                <input placeholder="Nhập thảo luận của bạn" />
                                <a href="javascript:ratingRelply(51256571);" class="rrSend">GỬI</a>
                                <div class="ifrl">
                                    <span>Khách</span> | <a href="javascript:rCmtEditName()">Nhập tên</a>
                                </div>
                            </div>

                        </div>

                    </div>



                    <div class="comment__item rp-51256571 childC__item hide" id="r-51295698">
                        <div class="item-top">
                            <p class="txtname">Ti&amp;#7871;n</p>


                        </div>
                        <div class="item-rate">


                        </div>

                        <div class="comment-content">
                            <p class="cmt-txt">Đang định mua . Hix</p>
                        </div>




                        <div class="item-click">
                            <a href="javascript:likeRating(51295698);" class="click-like" data-like="0">
                                <i class="icondetail-likewhite"></i>
                                H&#x1EEF;u &#xED;ch
                            </a>


                            <div class="rr-51295698 reply hide">
                                <input placeholder="Nhập thảo luận của bạn" />
                                <a href="javascript:ratingRelply(51295698);" class="rrSend">GỬI</a>
                                <div class="ifrl">
                                    <span>Khách</span> | <a href="javascript:rCmtEditName()">Nhập tên</a>
                                </div>
                            </div>

                        </div>

                    </div>



                    <div class="comment__item rp-51256571 childC__item hide" id="r-51359078">
                        <div class="item-top">
                            <p class="txtname">L&amp;#234; Dunhx</p>


                        </div>
                        <div class="item-rate">


                        </div>

                        <div class="comment-content">
                            <p class="cmt-txt">Bị lỗi gi bạn</p>
                        </div>




                        <div class="item-click">
                            <a href="javascript:likeRating(51359078);" class="click-like" data-like="0">
                                <i class="icondetail-likewhite"></i>
                                H&#x1EEF;u &#xED;ch
                            </a>


                            <div class="rr-51359078 reply hide">
                                <input placeholder="Nhập thảo luận của bạn" />
                                <a href="javascript:ratingRelply(51359078);" class="rrSend">GỬI</a>
                                <div class="ifrl">
                                    <span>Khách</span> | <a href="javascript:rCmtEditName()">Nhập tên</a>
                                </div>
                            </div>

                        </div>

                    </div>



                    <div class="comment__item rp-51256571 childC__item hide" id="r-51428112">
                        <div class="item-top">
                            <p class="txtname">V&amp;#361;</p>


                        </div>
                        <div class="item-rate">


                        </div>

                        <div class="comment-content">
                            <p class="cmt-txt">Lỗi gì thì ông ko nói nên đẩy sủa lỗi này lỗi kia. Đúng lỗi thì ông phải show được ra cho nhân viên ngta xem, chứ lỗi ứng dụng đòi đổi ai nghe</p>
                        </div>




                        <div class="item-click">
                            <a href="javascript:likeRating(51428112);" class="click-like" data-like="0">
                                <i class="icondetail-likewhite"></i>
                                H&#x1EEF;u &#xED;ch
                            </a>


                            <div class="rr-51428112 reply hide">
                                <input placeholder="Nhập thảo luận của bạn" />
                                <a href="javascript:ratingRelply(51428112);" class="rrSend">GỬI</a>
                                <div class="ifrl">
                                    <span>Khách</span> | <a href="javascript:rCmtEditName()">Nhập tên</a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>



                <div class="comment-btn">

                    <a href="javascript:showInputRating();" class="comment-btn__item blue"><i class="iconratingnew-circlestar--big"></i>Viết đánh giá</a>
                    <a href="/dtdd/samsung-galaxy-s22-ultra/danh-gia" class="comment-btn__item right-arrow"><span>Xem 26 đánh giá</span></a>
                </div>


                <div class="read-assess hide">
                    <form class="input frtip" name="fRatingComment">
                        <input type="hidden" name="hdfStar" id="hdfStar" value="0" />
                        <input type="hidden" name="hdfRtIsMobile" id="hdfRtIsMobile" value="false" />
                        <input type="hidden" name="hdfProductID" id="hdfProductID" value="235838" />
                        <input type="hidden" name="hdfIsShare" id="hdfIsShare" value="0" />
                        <input type="hidden" name="hdfSiteID" id="hdfSiteID" value="1" />
                        <input type="hidden" name="hdfRtImg" id="hdfRtImg" class="hdfRtImg" value="" />
                        <input type="hidden" name="hdfRtLink" id="hdfRtLink" value="" />

                        <div class="read-assess__top">
                            <p class="read-assess__title">Đánh giá</p>
                            <div class="read-assess-close btn-closemenu" onclick="hideInputRating()">Đóng</div>
                        </div>

                        <div class="read-assess-main">

                            <div class="box-cmt-popup">
                                <div class="info-pro" data-brand="Samsung" data-price="30990000.0" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB" data-id="235838" data-category="&#x110;i&#x1EC7;n tho&#x1EA1;i" data-is-production="True">
                                    <div class="img-cmt">
                                        <img data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg" class="lazyload" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB">
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
                                    <textarea class="ct" name="fRContent" placeholder="Mời bạn chia sẻ thêm một số cảm nhận về sản phẩm ..."></textarea>
                                    <div class="textarea-bottom clearfix">
                                        <a href="javascript:void(0)" class="send-img">
                                            <i class="icondetail-camera"></i>
                                            Gửi hình chụp thực tế
                                        </a>
                                        <input id="hdFileRatingUpload" type="file" class="hide" accept="image/x-png, image/gif, image/jpeg" />
                                        <ul class="resRtImg hide">
                                        </ul>
                                    </div>
                                </div>


                                <div class="txt-agree">
                                    <span></span>
                                    <p>Tôi sẽ giới thiệu sản phẩm này cho bạn bè người thân</p>
                                </div>

                                <div class="list-input">
                                    <input type="text" name="fRName" class="input-assess" placeholder="Họ và tên (bắt buộc)" value="">
                                    <input type="text" name="fRPhone" class="input-assess" placeholder="Số điện thoại (bắt buộc)" value="">
                                    <input type="text" name="fREmail" class="input-assess" placeholder="Email (không bắt buộc)" value="">

                                </div>


                                <a class="submit-assess" href="javascript:submitRatingComment()">Gửi đánh giá ngay</a>
                                <span class="lbMsgRt hide"></span>

                                <p class="assess-txtbt">Để đánh giá được duyệt, quý khách vui lòng tham khảo <a href="/huong-dan-dang-binh-luan">Quy định duyệt đánh giá</a></p>
                            </div>

                        </div>


                    </form>
                </div>

                <div class="rRepPopup hide">
                    <div class="rRepPopup__top">
                        <p class="rRepPopup__title">Nhập thông tin</p>
                        <div class="rRepPopup-close c-btnclose" onclick="hideReplyConfirmPopup()">Đóng</div>
                    </div>
                    <div class="rCfmInfo" data-gender="">
                        <div class="cgd ed">
                            <span class="c_male" onclick="rSelGender(this, 1)"><i class="icondetail-rad"></i>&nbsp;Anh</span>
                            <span class="c_female" onclick="rSelGender(this, 2)"><i class="icondetail-rad"></i>&nbsp;Chị</span>
                        </div>
                        <input type="text" placeholder="Họ tên (bắt buộc)" class="cfmUserName">
                        <input type="text" placeholder="Email (để nhận phản hồi qua mail)" class="cfmUserEmail">
                        <input type="text" placeholder="Số điện thoại" class="cfmPhone">
                        <button type="submit" onclick="rCmtConfirmUser(true, true);">Cập nhật</button>
                    </div>
                </div>


                <div class="show-comment">
                    <div class="show-comment-top">
                        <p class="show-comment-title" onclick="showRtImgListPop()">
                            <i class="icondetail-window"></i> Xem tất cả ảnh
                        </p>
                        <div class="comment-close btn-closemenu" onclick="closeRtGallery()">Đóng</div>
                    </div>

                    <div class="show-comment-main">
                        <div id="cmt_sync1" class="owl-carousel cmt-item-left">
                            <div class="cmt-img">
                                <img class="owl-lazy" data-src="https://cdn.tgdd.vn/comment/51043533/received_510390607157257284X1.jpeg" alt="">
                            </div>

                        </div>

                        <div id="cmt_sync2" class="owl-carousel cmt-item-right">
                            <div class="comment__item" data-id="279067">
                                <div class="item-top">
                                    <p class="txtname">Sang</p>




                                </div>
                                <div class="item-rate">
                                    <div class="comment-star">
                                        <i class="icon-star"></i>
                                        <i class="icon-star"></i>
                                        <i class="icon-star"></i>
                                        <i class="icon-star"></i>
                                        <i class="icon-star"></i>
                                    </div>
                                </div>
                                <div class="comment-content noimg crtipu-51043533" data-id="51043533">
                                    <p class="cmt-txt">Nhờ ad hướng dẫn cách zoom 100x với ạ</p>
                                </div>



                            </div>

                        </div>

                    </div>
                </div>
                <div class="gallery">
                    <div class="gallery__top">
                        <p class="gallery__title">4 ảnh từ khách hàng</p>
                        <div class="gallery-close btn-closemenu" onclick="closeRtGallery()">Đóng</div>
                    </div>
                    <div class="gallery__tab">
                        <a href="#all" class="act">Tất cả</a>
                        <a href="#sao5">5 sao</a>
                        <a href="#sao4">4 sao</a>
                        <a href="#sao3">3 sao</a>
                        <a href="#sao2">2 sao</a>
                        <a href="#sao1">1 sao</a>
                    </div>
                    <ul class="gallery__content">
                        <li class="sao5 rtAtt-279067" onclick="goToRSlide(1)">
                            <img class="lazyload" data-src="https://cdn.tgdd.vn/comment/51043533/received_510390607157257284X1.jpeg" alt="" />
                            <div class="gallery-rating">
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                            </div>
                        </li>

                    </ul>
                </div>






            </div>





        </div>
        <div class="box_right">


            <div class="scrolling_inner">
                <div class="box03 group desk">
                    <a href="/dtdd/samsung-galaxy-s22-ultra" data-index="0" class="box03__item item act">8GB/128GB</a>
                    <a href="/dtdd/samsung-galaxy-s22-ultra-256gb" data-index="1" class="box03__item item ">12GB/256GB</a>
                    <a href="/dtdd/samsung-galaxy-s22-ultra-512gb" data-index="2" class="box03__item item ">12GB/512GB</a>
                </div>
            </div>




            <div class="scrolling_inner">

                <div class="box03 color group desk">
                    <a href="/dtdd/samsung-galaxy-s22-ultra?code=0131491002959" data-color="2" data-code="0131491002959" class="box03__item item act">&#x110;&#x1ECF;</a>
                    <a href="/dtdd/samsung-galaxy-s22-ultra?code=0131491002976" data-color="12" data-code="0131491002976" class="box03__item item ">Tr&#x1EAF;ng</a>
                    <a href="/dtdd/samsung-galaxy-s22-ultra?code=0131491002977" data-color="11" data-code="0131491002977" class="box03__item item ">&#x110;en</a>
                    <a href="/dtdd/samsung-galaxy-s22-ultra?code=0131491002978" data-color="7" data-code="0131491002978" class="box03__item item ">Xanh l&#xE1;</a>
                </div>
            </div>



            <div class="box04 box_normal">

                <div class="box04__txt">
                    Gi&#xE1; t&#x1EA1;i <a href="javascript:;" onclick="OpenLocation()">H&#x1ED3; Ch&#xED; Minh</a>
                </div>


                <div class="price-one">
                    <div class="box-price">
                        <p class="box-price-present">30.990.000&#x20AB; </p>


                        <span class="label label--black">Trả góp 0%</span>
                    </div>
                </div>















                <div class="block block-price1">


                    <div class="block__promo">
                        <div class="pr-top">
                            <p class="pr-txtb">Khuyến mãi tr&#x1ECB; gi&#xE1; 2.000.000&#x20AB;</p>
                            <i class="pr-txt">Giá và khuyến mãi dự kiến áp dụng đến 23:00 16/05</i>
                        </div>
                        <div class="pr-content">
                            <div class="pr-item">
                                <div class="divb t1" data-promotion="1044089" data-group="T&#x1EB7;ng" data-discount="2000000" data-productcode="DISCOUNT" data-tovalue="2000000">
                                    <span class="nb">1</span>
                                    <div class="divb-right">
                                        <p>Giảm giá 2,000,000đ (Không áp dụng kèm Thu cũ Đổi mới)</p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="1024563" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="8000">
                                    <span class="nb">2</span>
                                    <div class="divb-right">
                                        <p>Giảm ngay 3,000,000đ qua Quà tặng Galaxy (lấy mã trên máy mới) <a href="http://www.thegioididong.com/tin-tuc/galaxy-s22-series-giam-gia-3-trieu-qua-qua-tang-galaxy-1425241"> Xem chi tiết</a></p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="1024566" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="7500">
                                    <span class="nb">3</span>
                                    <div class="divb-right">
                                        <p>Giảm đến 4,000,000đ khi Thu cũ Đổi mới (tùy model máy cũ) <a href="http://www.thegioididong.com/thu-cu-doi-moi"> Xem chi tiết</a></p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="1008131" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="7000">
                                    <span class="nb">4</span>
                                    <div class="divb-right">
                                        <p>Giảm ngay 3,000,000đ khi mua Galaxy Tab S8 kèm Galaxy S22</p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="932767" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="3000">
                                    <span class="nb">5</span>
                                    <div class="divb-right">
                                        <p>Ưu đãi phòng chờ hạng thương gia <a href="http://www.thegioididong.com/tin-tuc/s22-series-uu-dai-phong-cho-hang-thuong-gia-1417400"> Xem chi tiết</a></p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="932771" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="1000">
                                    <span class="nb">6</span>
                                    <div class="divb-right">
                                        <p>Trả góp 0% thẻ tín dụng, chuyển đổi qua Quà tặng Galaxy <a href="http://www.thegioididong.com/tin-tuc/mua-samsung-galaxy-tra-gop-0-qua-the-tin-dung-1386100"> Xem chi tiết</a></p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="1024576" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="500">
                                    <span class="nb">7</span>
                                    <div class="divb-right">
                                        <p>Giảm giá 30% gói bảo hiểm rơi vỡ, vào nước Samsung Care+ 12 tháng <a href="https://www.thegioididong.com/tin-tuc/samsung-care-plus-bao-hanh-toan-dien-thiet-bi-cua-ban-1428947"> Xem chi tiết</a></p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="1022828" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="100">
                                    <span class="nb">8</span>
                                    <div class="divb-right">
                                        <p>Mua kèm Samsung Galaxy Watch 4 giảm 15% (Không áp dụng khuyến mãi khác của đồng hồ)</p>
                                    </div>
                                </div>
                                <div class="divb t8" data-promotion="1017553" data-group="WebNote" data-discount="0" data-productcode="" data-tovalue="0">
                                    <span class="nb">9</span>
                                    <div class="divb-right">
                                        <p>Nhập mã DMX100 giảm 3% tối đa 100.000đ khi thanh toán quét QRcode qua App của ngân hàng <a href="http://www.thegioididong.com/tin-tuc/nhap-ma-giam-gia-vnpay-1377917"> Xem chi tiết</a></p>
                                    </div>
                                </div>
                            </div>






                        </div>
                    </div>




                    <script>
                        var dataDeli = {};
                        dataDeli.ProductId = 235838;
                        dataDeli.ProductCode = "";
                        dataDeli.ProvinceId = 3;
                        dataDeli.ProvinceName = "";
                        dataDeli.DistrictId = 0;
                        dataDeli.DistrictName = "";
                        dataDeli.WardId = 0;
                        dataDeli.WardName = "";
                        dataDeli.Address = "";
                        dataDeli.IsCheckSubmit = true;
                    </script>

                    <div id="status-delivery">
                        <div class="lddl">
                            <span class="xxx">
                    <span class="ball"></span>
                            <span class="ball"></span>
                            <span class="ball"></span>
                            </span>
                        </div>
                    </div>



                    <a href="javascript:void(0)" data-setup="False" data-proCode="0131491002959" data-proId="235838" data-onlystore="False" data-cateId="42" class="store jsSpmarket">
                        <i class="icondetail-store"></i>
                        Xem si&#xEA;u th&#x1ECB; c&#xF3; h&#xE0;ng
                    </a>
                    <div class="spmarket"></div>



                    <div class="campaign c2 dt">
                        <b>Ưu đãi khi thanh toán</b>
                        <div class="sliderX">
                            <div class="campaign-option" data-siteid="1" data-campaignname="JCB" onclick="ActiveOption($(this), '/cart/single?productId=235838&amp;productCode=0131491002959&amp;gtype=promotiongw&amp;transtype=31', 5000000)">
                                <figure class="onepayjcb">
                                    <i></i>
                                    <img src="//cdn.tgdd.vn/mwgcart/mwgcore/ContentMwg/images/logo/jcb.png" />
                                </figure>
                                <b>Giảm <b>500.000&#x20AB;</b></b>
                                <span>S&#x1EA3;n ph&#x1EA9;m t&#x1EEB; 5Tr</span>

                                <div>
                                    <i onmouseover="ShowRuleCampaign($(this), 'onepayjcb')" onmouseout="HideRuleCampaign($(this))">?</i>

                                    <div id="onepayjcb">- Áp dụng cho tất cả sản phẩm có GIÁ THANH TOÁN CUỐI CÙNG từ 5.000.000 đồng trở lên.<br />- Chỉ áp dụng cho ngày <strong>thứ 7, chủ nhật</strong> sau:<strong> </strong><span style="font-size:14px;"><span style="background-color: transparent; color: rgb(0, 0, 0); font-family: Arial; font-weight: 700; white-space: pre-wrap;">2/4, 3/4, 9/4, 10/4, 16/4, 17/4, 23/4, 24/4, 30/4, 01/5, 7/5, 8/5, 14/5, 15/5, 21/5, 22/5, 28/5, 29/5/2022</span></span><br
                                        />- Những sản phẩm có hiển thị thông tin khuyến mãi JCB thì mới được áp dụng khuyến mãi.<br />- Khách hàng phải dùng thẻ JCB (tất cả thẻ JCB được phát hành tại Việt Nam) để thanh toán online tại website dienmayxanh.com.<br
                                        />- Không áp dụng trả góp qua thẻ tín dụng JCB.<br />- Mỗi chủ thẻ được 1 lần khuyến mãi /1 ngày (số lần khuyến mãi không cộng gộp)</div>
                                </div>
                                <div class="cpopup hide onepayjcb" onclick="$(this).addClass('hide')">
                                    <div>
                                        Chương trình giảm thêm 500.000&#x20AB; khi thanh toán qua JCB chỉ áp dụng cho đơn hàng <b>từ 5.000.000&#x20AB; trở lên</b>
                                    </div>
                                </div>
                            </div>
                            <div class="campaign-option" data-siteid="1" data-campaignname="TPBank" onclick="ActiveOption($(this), '/cart/single?productId=235838&amp;productCode=0131491002959&amp;gtype=promotiongw&amp;transtype=48', 8000000)">
                                <figure class="tpbank">
                                    <i></i>
                                    <img src="//cdn.tgdd.vn/mwgcart/mwgcore/ContentMwg/images/logo/tpbank.png" />
                                </figure>
                                <b>Giảm <b>500.000&#x20AB;</b></b>
                                <span>S&#x1EA3;n ph&#x1EA9;m t&#x1EEB; 8Tr</span>

                                <div>
                                    <i onmouseover="ShowRuleCampaign($(this), 'tpbank')" onmouseout="HideRuleCampaign($(this))">?</i>

                                    <div id="tpbank">
                                        <p dir="ltr" role="presentation" style="font-variant-numeric: normal; font-variant-east-asian: normal; list-style-type: disc; font-size: 10pt; font-family: Roboto, sans-serif; color: rgb(36, 36, 36); background-color: transparent; vertical-align: baseline; white-space: pre; line-height: 1.848; margin-top: 6pt; margin-bottom: 0pt;"><span id="docs-internal-guid-de1a29cb-7fff-aa62-5a1b-eeb503c645dd"><span style="font-size: 10pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">- Giảm <strong>500.000đ </strong>cho sản phẩm có giá thanh toán cuối cùng từ <strong>8.000.000đ </strong>trở lên khi thanh toán qua Thẻ tín dụng TPBANK.</span></span>
                                        </p>
                                        <p dir="ltr" role="presentation" style="font-variant-numeric: normal; font-variant-east-asian: normal; list-style-type: disc; font-size: 10pt; font-family: Roboto, sans-serif; color: rgb(36, 36, 36); background-color: transparent; vertical-align: baseline; white-space: pre; line-height: 1.848; margin-top: 0pt; margin-bottom: 0pt;"><span id="docs-internal-guid-de1a29cb-7fff-aa62-5a1b-eeb503c645dd"><span style="font-size: 10pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">- Thời gian diễn ra chương trình: Từ ngày 15/4/2022  - 31/7/2022 (Có thể kết thúc sớm nếu hết ngân sách)<br />- Áp dụng cho thẻ tín dụng TPBANK với các đầu BIN: </span></span>466582,
                                            466583, 470970, 536287, 356586, 498796, 401286<br />- Số suất khuyến mãi: <strong>500 </strong>suất (Nếu hết suất thanh toán sẽ báo lỗi)</p>
                                        <p dir="ltr" role="presentation" style="font-variant-numeric: normal; font-variant-east-asian: normal; list-style-type: disc; font-size: 10pt; font-family: Roboto, sans-serif; color: rgb(36, 36, 36); background-color: transparent; vertical-align: baseline; white-space: pre; line-height: 1.848; margin-top: 0pt; margin-bottom: 0pt;"><span id="docs-internal-guid-de1a29cb-7fff-aa62-5a1b-eeb503c645dd"><span style="font-size: 10pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">- Mỗi chủ thẻ được sử dụng ưu đãi 1 lần/chương trình</span></span><br
                                            /><span style="background-color: transparent; font-size: 10pt; white-space: pre-wrap;">- Không áp dụng trả góp qua thẻ tín dụng TPBANK</span></p>
                                        <p dir="ltr" role="presentation" style="font-variant-numeric: normal; font-variant-east-asian: normal; list-style-type: disc; font-size: 10pt; font-family: Roboto, sans-serif; color: rgb(36, 36, 36); background-color: transparent; vertical-align: baseline; white-space: pre; line-height: 1.848; margin-top: 0pt; margin-bottom: 0pt;"><span id="docs-internal-guid-de1a29cb-7fff-aa62-5a1b-eeb503c645dd"><span style="font-size: 10pt; background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">- Không áp dụng kèm các khuyến mãi qua ngân hàng hoặc cổng thanh toán khác.</span></span><br
                                            /><span style="color: rgb(36, 36, 36); font-family: Roboto, sans-serif; font-size: 13.3333px; white-space: pre-wrap;">- Không áp dụng mã giảm giá, coupon.</span></p>
                                    </div>
                                </div>
                                <div class="cpopup hide tpbank" onclick="$(this).addClass('hide')">
                                    <div>
                                        Chương trình giảm thêm 500.000&#x20AB; khi thanh toán qua TPBANK chỉ áp dụng cho đơn hàng <b>từ 8.000.000&#x20AB; trở lên</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="crule hide"></div>
                    </div>
                    <script>
                        function ShowRuleCampaign($this, element) {
                            if ($this.hasClass('act')) {
                                $this.removeClass('act');
                                $('.crule').toggleClass('hide');
                            } else {
                                $('.crule').removeClass('hide');
                                $('.campaign>div>div>div>i.act').removeClass('act');
                                $this.toggleClass('act');
                            }

                            $('.crule').html($('#' + element).html());
                        }

                        function HideRuleCampaign($this) {
                            $this.removeClass('act');
                            $('.crule').toggleClass('hide');
                        }

                        function CheckApply($this, url, min) {
                            var option = $this;
                            if (($('.choosepromo .label-radio.active').length > 0 || $('.kmml21 .kmbox.active').length > 0) && min > 0) {
                                var price = parseInt(30990000);
                                var discount = parseInt(0);
                                $('.choosepromo .label-radio.active').each(function() {
                                    var $parent = $(this).parent();
                                    var value = parseInt($parent.data('discount'));
                                    if (value > 0) {
                                        discount += $parent.data('ispercent') == 'True' ? (value * price / 100) : value;
                                    }
                                });

                                $('.kmml21 .kmbox.active').each(function() {
                                    var $parent = $(this);
                                    var value = parseInt($parent.data('discount'));
                                    if (value > 0) {
                                        discount += $parent.data('ispercent') == 'True' ? (value * price / 100) : value;
                                    }
                                });

                                if (price - discount < min) {
                                    option.find('.cpopup').removeClass('hide');
                                } else {
                                    window.location.href = url;
                                }
                            } else {
                                window.location.href = url;
                            }
                        }

                        function ActiveOption($this, url, min) {
                            var option = $this;
                            if (option.hasClass('active')) {
                                option.removeClass('active');
                                $('.btn-camp').remove();
                                $('.block-button.normal .btn-buynow').show();
                            } else {
                                option.siblings().removeClass('active');
                                option.addClass('active');

                                $('.block-button.normal .btn-buynow').hide();

                                if ($('.btn-camp').length > 0) {
                                    $('.btn-camp').remove();
                                }

                                var newButton = $('<a class="btn-camp"></a>');
                                newButton.click(() => CheckApply($this, url, min))
                                newButton.text(`MUA NGAY QUA ${$this.data('campaignname')}`);
                                $('.block-button.normal').prepend(newButton);
                            }
                        }

                        function gtm_trakking(url) {
                            var obj = getModelTracking();
                            obj.orderType = "Mua ngay Vnpay";
                            var obj = getModelTracking();
                            if (url.indexOf("vnpayqr") != -1) {
                                obj.productPromoyionType = "Khuyến mãi thường";
                                obj.orderType = "Mua ngay Vnpay";
                            } else {
                                if (url.indexOf("onepayjcb") != -1) {
                                    obj.orderType = "Mua ngay Onepay JCB";
                                } else {
                                    if (url.indexOf("fecredit") != -1) {
                                        obj.orderType = "Mua ngay FeCredit";
                                    } else {
                                        obj.orderType = "Mua ngay Tpbank";
                                    }
                                }
                            }
                            gtm_ProductAddtoCart(obj);
                        }
                    </script>
                    <style>
                        .campaign.dt>div::-webkit-scrollbar {
                            width: 6px;
                            height: 6px
                        }

                        .campaign.dt>div::-webkit-scrollbar-track {
                            border-radius: 10px;
                            background: rgba(0, 0, 0, 0.1)
                        }

                        .campaign.dt>div::-webkit-scrollbar-thumb {
                            border-radius: 10px;
                            background: rgba(0, 0, 0, 0.2)
                        }

                        .campaign.dt>div::-webkit-scrollbar-thumb:hover {
                            background: rgba(0, 0, 0, 0.4)
                        }

                        .campaign.dt>div::-webkit-scrollbar-thumb:active {
                            background: rgba(0, 0, 0, .9)
                        }

                        .campaign {
                            margin-bottom: 10px;
                            padding-top: 12px;
                            border-top: 1px solid #E0E0E0;
                            white-space: nowrap;
                            position: relative
                        }

                        .campaign>div.sliderX {
                            display: flex;
                            overflow-x: scroll;
                            -webkit-overflow-scrolling: touch;
                            -ms-scroll-chaining: chained;
                            padding-bottom: 10px
                        }

                        .campaign>b {
                            display: block;
                            margin-bottom: 10px;
                            font-size: 16px
                        }

                        .campaign>div>div {
                            min-width: calc(40% - 3px);
                            display: inline-block;
                            vertical-align: top;
                            padding: 10px 10px 8px;
                            border: 1px solid #e0e0e0;
                            border-radius: 4px;
                            position: relative;
                            flex-shrink: 0;
                            margin-right: 5px;
                            cursor: pointer;
                            overflow: hidden;
                        }

                        .campaign>div>div:last-of-type {
                            margin-right: 0
                        }

                        .campaign>div>div>* {
                            display: block;
                            margin-bottom: 2px
                        }

                        .campaign>div>div>figure {
                            height: 16px;
                            position: relative;
                            margin-bottom: 6px
                        }

                        .campaign>div>div>figure>img {
                            max-height: 100%;
                            top: 0;
                            bottom: 0;
                            left: 0;
                            margin: auto
                        }

                        .campaign>div>div>figure.jcb>img {
                            height: 15px
                        }

                        .campaign>div>div>figure.tpbank>img {
                            height: 13px
                        }

                        .campaign>div>div>figure.fecredit>img {
                            height: 8px
                        }

                        .campaign>div>div>figure.vnpayqr>img {
                            height: 10px
                        }

                        .campaign>div>div>figure.fundiin>img {
                            height: 15px
                        }

                        .campaign>div>div>b {
                            color: #000;
                            font-weight: 400
                        }

                        .campaign>div>div>b>span {
                            font-size: 12px;
                            color: #666
                        }

                        .campaign>div>div>span {
                            font-size: 12px;
                            color: #666
                        }

                        .campaign>div>div>a {
                            font-weight: 400;
                            color: #FB6E2E;
                            margin-bottom: 0
                        }

                        .campaign>div>div>div {
                            width: 16px;
                            height: 16px;
                            position: absolute;
                            right: 20px;
                            top: 10px
                        }

                        .campaign>div>div>div>i {
                            font-style: normal;
                            width: 16px;
                            height: 16px;
                            border-radius: 50%;
                            display: block;
                            background-color: #999;
                            color: #fff;
                            font-size: 10px;
                            text-align: center;
                            line-height: 16px;
                            position: relative;
                            cursor: pointer
                        }

                        .campaign>div>div>div>i.act {
                            background-color: #2F80ED
                        }

                        .campaign>div>div>div>i.act:before {
                            content: "";
                            position: absolute;
                            width: 12px;
                            height: 12px;
                            background: #e0e0e0;
                            transform: rotate(45deg);
                            top: 15px;
                            right: 2px;
                            box-shadow: -2px -2px 5px -4px
                        }

                        .campaign>div>div>div>div {
                            display: none
                        }

                        .campaign div.crule {
                            position: absolute;
                            right: 0;
                            top: 70px;
                            padding: 10px;
                            border-radius: 4px;
                            width: 100%;
                            background-color: #fff;
                            border: 1px solid #E0E0E0;
                            z-index: 5;
                            white-space: normal;
                            line-height: 1.5;
                            box-shadow: 0 0 8px #ccc
                        }

                        .campaign div.crule>* {
                            margin-bottom: 10px;
                            color: #333;
                            white-space: normal
                        }

                        .campaign .cpopup {
                            position: fixed !important;
                            left: 0 !important;
                            top: 0 !important;
                            width: 100%;
                            height: 100vh;
                            background: rgba(0, 0, 0, .85);
                            z-index: 10
                        }

                        .campaign .cpopup>div {
                            width: 320px;
                            position: absolute;
                            left: 0;
                            right: 0;
                            top: 0;
                            bottom: 0;
                            margin: auto;
                            background-color: #fff;
                            border-radius: 4px;
                            padding: 20px;
                            line-height: 1.5;
                            text-align: center;
                            height: 105px;
                            display: block;
                            white-space: normal
                        }

                        .campaign .cpopup>div:before {
                            content: "×";
                            position: absolute;
                            right: 7px;
                            top: -5px;
                            font-size: 26px
                        }

                        .campaign.dt.c1>div>div>a {
                            float: right
                        }

                        .campaign.mb>div {
                            overflow-x: scroll;
                            -webkit-overflow-scrolling: touch;
                            -ms-scroll-chaining: chained
                        }

                        .campaign.mb>div>div {
                            min-width: calc(43% - 3px)
                        }

                        .campaign.mb.c1>div>div>a {
                            display: block;
                            padding-top: 2px
                        }

                        .campaign.c1>div>div {
                            width: calc(100% - 3px)
                        }

                        .campaign.c1>div>div>* {
                            display: inline-block;
                            vertical-align: middle;
                            margin-right: 2px
                        }

                        .campaign.c1>div>div>div {
                            position: relative;
                            left: 0;
                            top: 0
                        }

                        .campaign.c1>div>div>figure>* {
                            display: inline-block;
                            vertical-align: middle;
                        }

                        .campaign.c1>div>div>figure.fecredit {
                            height: 20px
                        }

                        .campaign.c1>div>div>figure>img {
                            position: relative
                        }

                        .campaign.c2>div>div {
                            width: calc((100% / 2) - 3px)
                        }

                        .campaign.c2 .sliderX::-webkit-scrollbar,
                        .campaign.c1 .sliderX::-webkit-scrollbar {
                            display: none
                        }

                        .campaign.c2 .sliderX {
                            justify-content: center;
                        }

                        .campaign:not(.c1) .sliderX>div>b>span:last-of-type {
                            display: block
                        }

                        .campaign-option>figure>i {
                            width: 16px;
                            height: 16px;
                            border: 1px solid #ccc;
                            border-radius: 50%;
                            padding: 3px;
                            border: 1px solid #fb6e2e;
                            display: inline-block;
                            font-size: 16px;
                            cursor: pointer;
                        }

                        .campaign-option.active {
                            border: 1px solid #fb6e2e;
                        }

                        .campaign-option.active>figure>i::before {
                            content: "";
                            display: block;
                            height: 100%;
                            background-color: #fb6e2e;
                            border-radius: 50%;
                        }

                        .campaign-option.active:after {
                            content: '';
                            width: 4px;
                            height: 8px;
                            border: solid #fff;
                            border-width: 0 2px 2px 0;
                            transform: rotate(45deg);
                            background: none;
                            margin: -2px 0 0 2px;
                            border-radius: 0;
                            position: absolute;
                            right: 5px;
                            top: 3px
                        }

                        .campaign-option.active:before {
                            content: '';
                            width: 0;
                            height: 0;
                            border-top: 30px solid #fb6e2e;
                            border-left: 30px solid transparent;
                            position: absolute;
                            right: -1px;
                            top: -1px
                        }

                        .block-button.normal .btn-camp {
                            background-color: #fb6e2e;
                            border-radius: 4px;
                            color: #fff;
                            display: block;
                            font-size: 15px;
                            padding: 14px 10px;
                            text-align: center;
                            margin-bottom: 8px;
                            display: block;
                            padding-left: 0;
                            padding-right: 0;
                            text-transform: uppercase;
                            width: 100%;
                            cursor: pointer;
                        }

                        .avaworld .campaign-option.active,
                        .avaworld .campaign-option>figure>i {
                            border-color: #000020;
                        }

                        .avaworld .campaign-option.active>figure>i::before {
                            background-color: #000020;
                        }

                        .avaworld .campaign-option.active:before {
                            border-top-color: #000020;
                        }
                    </style>







                    <div class="block-button normal  hide">
                        <a href="/cart/them-vao-gio-hang?productId=235838&amp;productCode=0131491002959&amp;productType=1" class="btn-buynow jsBuy">MUA NGAY</a>

                        <a href="/tra-gop/dtdd/samsung-galaxy-s22-ultra?code=0131491002959" class="btn-ins pay-taichinh full  btn-left">
                            MUA TRẢ GÓP 0%
                            <span>Duyệt hồ sơ trong 5 phút</span>
                        </a>
                    </div>
                    <div id="app"></div>
                    <script>
                        var isMobile = 0;
                        var versionjs = '831dd2cd8aa269a364d5';
                        var linkCss = '//cdn.tgdd.vn/mwgcart/vue-pro';
                        var linkJs = `//cdn.tgdd.vn/mwgcart/vue-pro/js/index2.${versionjs}.js`;
                        window.provinceId = 3;
                        window.index3State = {
                            productId: 235838,
                            productCode: '0131491002959',
                            productName: '&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB',
                            productType: 1,
                            isTransContact: false,
                            isUserManual: false,
                            lstProductCodeMoreColors: "",
                            bringProductsName: '',
                            indexGiftAdds: []
                        };

                        function getScript(source, callback) {
                            //document.getElementById("cartloading").style.display = 'block';
                            var el = document.createElement('script');
                            el.onload = callback;
                            el.src = source;
                            el.async = true;
                            document.body.appendChild(el);
                        }

                        function getCss(source) {
                            var link = document.createElement('link');
                            link.rel = 'stylesheet';
                            link.type = 'text/css';
                            link.href = source;
                            document.head.appendChild(link);
                        }

                        function updateListSelectedPromotionsInPageDetail(listSelecteGiftPromotions) {
                            window.index2State.indexGiftAdds = listSelecteGiftPromotions;
                            if (listSelecteGiftPromotions.length > 0) {
                                var classParent = listSelecteGiftPromotions[0].productType === 1 ? ".box_normal" : ".box_saving"
                                $(classParent + ' .label-radio').removeClass('active');
                                for (var i = 0; i < listSelecteGiftPromotions.length; i++) {
                                    var item = listSelecteGiftPromotions[i];
                                    $(classParent + ' .label-radio[data-promotion="' + item.promotionId + '"]:eq(' + item.promotionGiftIndex + ')').addClass('active');
                                }
                            }
                        }

                        function choosePromotion($this, type) {
                            var box = type == 1 ? ".box_normal" : ".box_saving";
                            var $parent = $this.parent().parent();
                            $parent.find('.label-radio').removeClass('active');
                            $this.addClass('active');

                            var text = '';
                            $(box + ' .label-radio.active').each(function() {
                                text += $(this).html() + ' và ';
                            });

                            $(box + ' .showpromo-radio').removeClass('hide');
                            $(box + ' .showpromo-radio span').html(text.substring(0, text.length - 4));

                            if (typeof window.index2State !== "undefined") {
                                window.index2State.indexGiftAdds = [];
                                $(box + ' .label-radio.active').each(function() {
                                    window.index2State.indexGiftAdds.push({
                                        promotionId: $this.data('promotion'),
                                        promotionGiftIndex: $this.data('index'),
                                        productType: type
                                    });
                                });
                            }

                            //Tính lại hiển thị text hiển thị km chọn cho kb saving
                            //if (type == 2) {
                            //    $('.box_saving').addClass('choosed');
                            //    $('.box_saving.choosed .bs_rule').css('padding-bottom', ($('.box_saving.choosed .showpromo-radio').height() + 14) + 'px');
                            //    $('.box_saving.choosed .showpromo-radio').css('bottom', ($('.box_saving.choosed .block-button').height() + 10) + 'px');
                            //}
                        }

                        function CallBackVue() {
                            window.index2State = window.index3State;
                            var list = document.querySelectorAll(".normal .jsBuy");
                            for (var i = 0; i < list.length; i++) {
                                if (list[i].className.indexOf('skip') !== -1)
                                    continue;
                                list[i].href = "javascript:void(0);";
                                list[i].addEventListener("click", function() {
                                    if (!dataDeli.IsCheckSubmit) {
                                        //CheckDelivery();
                                        return false;
                                    } else {
                                        window.index2State.productType = 1;
                                        $("#btn-add-product").click();
                                        return false;
                                    }
                                });
                            }

                            var listsaving = document.querySelectorAll(".saving .jsBuy");
                            for (var i = 0; i < listsaving.length; i++) {
                                if (listsaving[i].className.indexOf('skip') !== -1)
                                    continue;
                                listsaving[i].href = "javascript:void(0);";
                                listsaving[i].addEventListener("click", function() {
                                    if (!dataDeli.IsCheckSubmit) {
                                        //CheckDelivery();
                                        return false;
                                    } else {
                                        window.index2State.productType = 2;
                                        $("#btn-add-product").click();
                                        return false;
                                    }
                                });
                            }

                            var listOLOL = document.querySelectorAll(".onlineonly .jsBuy");
                            for (var i = 0; i < listOLOL.length; i++) {
                                if (listOLOL[i].className.indexOf('skip') !== -1)
                                    continue;
                                listOLOL[i].href = "javascript:void(0);";
                                listOLOL[i].addEventListener("click", function() {
                                    if (!dataDeli.IsCheckSubmit) {
                                        return false;
                                    } else {
                                        window.index2State.productType = 4;
                                        $("#btn-add-product").click();
                                        return false;
                                    }
                                });
                            }

                            var listTwoPrice = document.querySelectorAll(".twoprice .jsBuy");
                            for (var i = 0; i < listTwoPrice.length; i++) {
                                if (listTwoPrice[i].className.indexOf('skip') !== -1)
                                    continue;
                                listTwoPrice[i].href = "javascript:void(0);";
                                listTwoPrice[i].addEventListener("click", function() {
                                    if (!dataDeli.IsCheckSubmit) {
                                        return false;
                                    } else {
                                        window.index2State.productType = 3;
                                        $("#btn-add-product").click();
                                        return false;
                                    }
                                });
                            }

                            var listTwoPriceOLOL = document.querySelectorAll(".twopriceolol .jsBuy");
                            for (var i = 0; i < listTwoPriceOLOL.length; i++) {
                                if (listTwoPriceOLOL[i].className.indexOf('skip') !== -1)
                                    continue;
                                listTwoPriceOLOL[i].href = "javascript:void(0);";
                                listTwoPriceOLOL[i].addEventListener("click", function() {
                                    if (!dataDeli.IsCheckSubmit) {
                                        return false;
                                    } else {
                                        window.index2State.productType = 6;
                                        $("#btn-add-product").click();
                                        return false;
                                    }
                                });
                            }

                            var listCleanStock = document.querySelectorAll(".cleanstock .jsBuy");
                            for (var i = 0; i < listCleanStock.length; i++) {
                                if (listCleanStock[i].className.indexOf('skip') !== -1)
                                    continue;
                                listCleanStock[i].href = "javascript:void(0);";
                                listCleanStock[i].addEventListener("click", function() {
                                    if (!dataDeli.IsCheckSubmit) {
                                        return false;
                                    } else {
                                        window.index2State.productType = 7;
                                        $("#btn-add-product").click();
                                        return false;
                                    }
                                });
                            }
                        }

                        setTimeout(function() {
                            getScript(linkJs, function() {
                                console.log('getScript ' + versionjs);
                            });

                            if (isMobile == 1) {
                                getCss(linkCss + "/css/mobile/global-detail.css?v=" + versionjs);
                                getCss(linkCss + "/css/mobile/popup-detail.css?v=" + versionjs);
                                getCss(linkCss + "/css/mobile/alert.css?v=" + versionjs);
                            } else {
                                getCss(linkCss + "/css/desktop/global-detail.css?v=" + versionjs);
                                getCss(linkCss + "/css/desktop/popup-detail.css?v=" + versionjs);
                                getCss(linkCss + "/css/desktop/alert.css?v=" + versionjs);
                            }
                        }, 100);
                    </script>



                    <p class="callorder">
                        Gọi đặt mua <a href="tel:18001060">1800.1060</a> (7:30 - 22:00)
                    </p>













                    <div class="promoadd " data-max="2">
                        <p class="promoadd__ttl">
                            <em><b class="bonus_count">7</b> ưu đãi thêm</em>
                            <span>Dự kiến áp dụng đến 23:00 31/05</span>
                        </p>
                        <ul class="promoadd__list">
                            <li class="bhx hide">
                                <i class="icondetail-tick"></i>
                                <div class="promo_BHX">
                                    <div class="l2">
                                        <span>
                                    Tặng cho khách lần đầu mua hàng online tại web <a href="https://www.bachhoaxanh.com/?utm_source=tgdd_ttc_tct_20%&amp;utm_medium=link_tct&amp;utm_campaign=tgdd">BachhoaXANH.com</a>
                                </span>
                                        <div class="content">
                                            <p class="first-pap">Mã giảm <strong>20% t&#x1ED1;i &#x111;a 100.000&#x111;</strong></p>

                                            <p><b>FREEship</b> đơn hàng từ 300.000đ</p>
                                        </div>
                                        <span>
                                    Áp dụng tại Tp.HCM và 1 số khu vực, <b>1 SĐT nhận 1 lần</b>
                                </span>
                                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/tang-phieu-mua-hang-bachhoaxanhcom-khi-mua-sam-tai-thegioididongcom-va-dienmayxanhcom-1276540?utm_source=tgdd_ttc_tct_the_le_20%&amp;utm_medium=link_tct&amp;utm_campaign=tgdd" target="_blank">(Xem chi tiết)</a>
                                    </div>
                                </div>
                            </li>

                            <li class="" data-tovalue="97" data-promotion="1032082">
                                <i class="icondetail-tick"></i>
                                <p>Tặng suất mua xe đạp Giảm đến 30% (không kèm khuyến mãi khác)
                                    <A href="https://www.dienmayxanh.com/khuyen-mai/xe-dap-giam-den-20-khi-mua-kem-tv-tu-lanh-may-g-1377323" target=_blank>(click xem chi tiết)</EM></A>
                                    </FONT>
                                </p>
                            </li>
                            <li class="hide" data-tovalue="90" data-promotion="1022027">
                                <i class="icondetail-tick"></i>
                                <p>Tặng suất mua kèm đồng hồ Beu giảm 30% (không áp dụng khuyến mãi khác của đồng hồ)</p>
                            </li>
                            <li class="hide" data-tovalue="0" data-promotion="1043304">
                                <i class="icondetail-tick"></i>
                                <p>Ốp lưng giảm 24% khi mua kèm điện thoại Galaxy S22 Ultra</p>
                            </li>
                            <li class="hide" data-tovalue="0" data-promotion="1034772">
                                <i class="icondetail-tick"></i>
                                <p>Mua Đồng hồ thời trang giảm 40% cho Đồng hồ dưới 3 triệu, giảm 30% cho Đồng hồ từ 3 triệu trở lên</p>
                            </li>
                            <li class="hide" data-tovalue="0" data-promotion="1019671">
                                <i class="icondetail-tick"></i>
                                <p>Sạc dự phòng giảm 30% khi mua kèm Điện thoại, Laptop, Tablet</p>
                            </li>
                            <li class="hide" data-tovalue="0" data-promotion="1019277">
                                <i class="icondetail-tick"></i>
                                <p>Buds 2 giảm 1 triệu khi mua kèm điện thoại, tablet Samsung trên 5 triệu</p>
                            </li>
                        </ul>

                        <a href="javascript:void(0)" onclick="$(this).remove(); $('.promoadd__list li').removeClass('hide');" class="promoadd-more">Xem thêm 5 ưu đãi khác</a>
                    </div>


                </div>
            </div>
            <div class="border7"></div>




            <p class="parameter__title">C&#x1EA5;u h&#xEC;nh &#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB</p>
            <div class="parameter">
                <ul class="parameter__list 235838 active">
                    <li data-index="0" data-prop="0">
                        <p class="lileft">M&#xE0;n h&#xEC;nh:</p>
                        <div class="liright">
                            <span class="comma">Dynamic AMOLED 2X</span>
                            <span class="comma">6.8"</span>
                            <span class="">Quad HD+ (2K+)</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">H&#x1EC7; &#x111;i&#x1EC1;u h&#xE0;nh:</p>
                        <div class="liright">
                            <span class="">Android 12</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">Camera sau:</p>
                        <div class="liright">
                            <span class="">Chính 108 MP & Phụ 12 MP, 10 MP, 10 MP</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">Camera tr&#x1B0;&#x1EDB;c:</p>
                        <div class="liright">
                            <span class="">40 MP</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">Chip:</p>
                        <div class="liright">
                            <span class="">Snapdragon 8 Gen 1 8 nhân</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">RAM:</p>
                        <div class="liright">
                            <span class="">8 GB</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">B&#x1ED9; nh&#x1EDB; trong:</p>
                        <div class="liright">
                            <span class="">128 GB</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">SIM:</p>
                        <div class="liright">
                            <span class="comma">2 Nano SIM hoặc 1 Nano SIM + 1 eSIM</span>
                            <span class="">Hỗ trợ 5G</span>
                        </div>
                    </li>
                    <li data-index="0" data-prop="0">
                        <p class="lileft">Pin, S&#x1EA1;c:</p>
                        <div class="liright">
                            <span class="comma">5000 mAh</span>
                            <span class="">45 W</span>
                        </div>
                    </li>
                </ul>
                <span class="btn-detail btn-short-spec not-have-instruction">
                    <span>Xem th&#xEA;m c&#x1EA5;u h&#xEC;nh chi ti&#x1EBF;t</span>
                </span>
            </div>

        </div>
        
        <div class="border7"></div>

        <div class="related sameproduct">
            <p class="related__ttl">Xem thêm &#x111;i&#x1EC7;n tho&#x1EA1;i khác</p>

            <div class="scrolling_inner">
                <div class="box03 box03--nopadd scrolling">
                    <a href="/dtdd-samsung" class="box03__item addradius">
                        <img class="lazyload" data-src="//cdn.tgdd.vn/Brand/1/samsungnew-220x48-1.png" />
                    </a>
                    <a href="/dtdd-galaxy-s" class="box03__item addradius">
                        Galaxy S                        </a>
                    <a href="/dtdd?g=android" class="box03__item addradius">
                        Android                        </a>
                    <a href="/dtdd-ram-8gb" class="box03__item addradius">
                        8 GB                        </a>
                    <a href="/dtdd-choi-game" class="box03__item addradius">
                        Ch&#x1A1;i game / C&#x1EA5;u h&#xEC;nh cao                        </a>
                    <a href="/dtdd-sac-pin-nhanh" class="box03__item addradius">
                        S&#x1EA1;c pin nhanh                        </a>
                    <a href="/dtdd-rom-128gb" class="box03__item addradius">
                        128 GB                        </a>
                    <a href="/dtdd-camera-goc-rong" class="box03__item addradius">
                        Ch&#x1EE5;p g&#xF3;c r&#x1ED9;ng                        </a>
                    <a href="/dtdd-camera-xoa-phong" class="box03__item addradius">
                        Ch&#x1EE5;p xo&#xE1; ph&#xF4;ng                        </a>
                    <a href="/dtdd-camera-zoom" class="box03__item addradius">
                        Ch&#x1EE5;p zoom xa                        </a>
                    <a href="/dtdd-5g" class="box03__item addradius">
                        H&#x1ED7; tr&#x1EE3; 5G                        </a>
                    <a href="/dtdd-sac-khong-day" class="box03__item addradius">
                        S&#x1EA1;c kh&#xF4;ng d&#xE2;y                        </a>
                    <a href="/dtdd-chong-nuoc-bui" class="box03__item addradius">
                        Kh&#xE1;ng n&#x1B0;&#x1EDB;c, b&#x1EE5;i                        </a>
                    <a href="/dtdd-man-hinh-tran-vien" class="box03__item addradius">
                        Tr&#xE0;n vi&#x1EC1;n                        </a>
                    <a href="/dtdd-mong-nhe" class="box03__item addradius">
                        M&#x1ECF;ng nh&#x1EB9;                        </a>
                    <a href="/dtdd-mat-lung-kinh" class="box03__item addradius">
                        M&#x1EB7;t l&#x1B0;ng k&#xED;nh                        </a>
                    <a href="/dtdd-tu-6-inch-tro-len" class="box03__item addradius">
                        T&#x1EEB; 6 inch tr&#x1EDF; l&#xEA;n                        </a>
                </div>
            </div>


            <div class="box-scroll p-slide">
                <div class="listproduct owl-carousel" data-item="5">
                    <div class="item" data-id="235838" data-pos="1">
                        <a class="box-product" href='/dtdd/samsung-galaxy-s22-ultra?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB"
                           data-id="235838" data-price="30990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB">
                            </div>
                            <p class="txt01">Bạn đang xem:</p>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB">
                                Samsung Galaxy S22 Ultra 5G 128GB
                            </h3>
                            <strong class="price">30.990.000&#x20AB;</strong>
                            <p class="item-gift">Giảm thêm <b>2.000.000₫</b></p>
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star-dark"></i>
                                    <i class="icon-star-dark"></i>
                                </p>
                                <p class="item-rating-total">25</p>
                            </div>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="226316" data-pos="2">
                        <a class="box-product" href='/dtdd/samsung-galaxy-s21-ultra?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S21 Ultra 5G 128GB"
                           data-id="226316" data-price="22990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/226316/samsung-galaxy-s21-ultra-bac-600x600-1-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S21 Ultra 5G 128GB">
                            </div>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S21 Ultra 5G 128GB">
                                Samsung Galaxy S21 Ultra 5G 128GB
                            </h3>
                            <div class="box-p">
                                <p class="price-old black">30.990.000&#x20AB;</p>
                                <span class="percent">-25%</span>
                            </div>
                            <strong class="price">22.990.000&#x20AB;</strong>
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star-dark"></i>
                                    <i class="icon-star-dark"></i>
                                </p>
                                <p class="item-rating-total">178</p>
                            </div>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="271697" data-pos="3">
                        <a class="box-product" href='/dtdd/samsung-galaxy-s22-ultra-256gb?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 256GB"
                           data-id="271697" data-price="33990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/271697/Galaxy-S22-Ultra-Green-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 256GB">
                            </div>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 256GB">
                                Samsung Galaxy S22 Ultra 5G 256GB
                            </h3>
                            <strong class="price">33.990.000&#x20AB;</strong>
                            <p class="item-gift">Giảm thêm <b>2.000.000₫</b></p>
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star-dark"></i>
                                </p>
                                <p class="item-rating-total">20</p>
                            </div>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="271696" data-pos="4">
                        <a class="box-product" href='/dtdd/samsung-galaxy-s22-plus-256gb?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22&#x2B; 5G 256GB"
                           data-id="271696" data-price="27490000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/271696/Galaxy-S22-Plus-Pink-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22&#x2B; 5G 256GB">
                            </div>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22&#x2B; 5G 256GB">
                                Samsung Galaxy S22+ 5G 256GB
                            </h3>
                            <strong class="price">27.490.000&#x20AB;</strong>
                            <p class="item-gift">Giảm thêm <b>2.000.000₫</b></p>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="248283" data-pos="5">
                        <a class="box-product" href='/dtdd/samsung-galaxy-z-flip3-5g-256gb?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy Z Flip3 5G 256GB"
                           data-id="248283" data-price="20990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/248283/samsung-galaxy-z-flip-3-violet-1-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy Z Flip3 5G 256GB">
                            </div>
                            <p class='result-label temp5'><img width='20' height='20' class='lazyload' alt='GIẢM KỊCH SÀN' data-src='https://cdn.tgdd.vn/2022/05/content/labelseagames-50x50-6.png'><span>GIẢM KỊCH SÀN</span></p>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy Z Flip3 5G 256GB">
                                Samsung Galaxy Z Flip3 5G 256GB
                            </h3>
                            <div class="box-p">
                                <p class="price-old black">26.990.000&#x20AB;</p>
                                <span class="percent">-22%</span>
                            </div>
                            <strong class="price">20.990.000&#x20AB;</strong>
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star-dark"></i>
                                </p>
                                <p class="item-rating-total">29</p>
                            </div>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="226385" data-pos="6">
                        <a class="box-product" href='/dtdd/samsung-galaxy-s21-plus?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S21&#x2B; 5G 128GB"
                           data-id="226385" data-price="17990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/226385/samsung-galaxy-s21-plus-den-600x600-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S21&#x2B; 5G 128GB">
                            </div>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S21&#x2B; 5G 128GB">
                                Samsung Galaxy S21+ 5G 128GB
                            </h3>
                            <div class="box-p">
                                <p class="price-old black">25.990.000&#x20AB;</p>
                                <span class="percent">-30%</span>
                            </div>
                            <strong class="price">17.990.000&#x20AB;</strong>
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star-dark"></i>
                                    <i class="icon-star-dark"></i>
                                </p>
                                <p class="item-rating-total">148</p>
                            </div>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="242439" data-pos="7">
                        <a class="box-product" href='/dtdd/samsung-galaxy-s22-plus?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22&#x2B; 5G 128GB"
                           data-id="242439" data-price="25990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/242439/Galaxy-S22-Plus-White-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22&#x2B; 5G 128GB">
                            </div>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22&#x2B; 5G 128GB">
                                Samsung Galaxy S22+ 5G 128GB
                            </h3>
                            <strong class="price">25.990.000&#x20AB;</strong>
                            <p class="item-gift">Giảm thêm <b>2.000.000₫</b></p>
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </p>
                                <p class="item-rating-total">7</p>
                            </div>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="229949" data-pos="8">
                        <a class="box-product" href='/dtdd/samsung-galaxy-z-flip-3?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy Z Flip3 5G 128GB"
                           data-id="229949" data-price="18990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/229949/samsung-galaxy-z-flip-3-cream-1-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy Z Flip3 5G 128GB">
                            </div>
                            <p class='result-label temp5'><img width='20' height='20' class='lazyload' alt='GIẢM KỊCH SÀN' data-src='https://cdn.tgdd.vn/2022/05/content/labelseagames-50x50-6.png'><span>GIẢM KỊCH SÀN</span></p>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy Z Flip3 5G 128GB">
                                Samsung Galaxy Z Flip3 5G 128GB
                            </h3>
                            <div class="box-p">
                                <p class="price-old black">24.990.000&#x20AB;</p>
                                <span class="percent">-24%</span>
                            </div>
                            <strong class="price">18.990.000&#x20AB;</strong>
                            <div class="item-rating">
                                <p>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star-dark"></i>
                                </p>
                                <p class="item-rating-total">37</p>
                            </div>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                    <div class="item" data-id="271698" data-pos="9">
                        <a class="box-product" href='/dtdd/samsung-galaxy-s22-ultra-512gb?src=osp&amp;itm_source=detail&amp;itm_medium=product_card&amp;itm_campaign=viewed' data-s="Nomal" data-site="1" data-pro="3" data-cache="True" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 512GB"
                           data-id="271698" data-price="36990000.0" data-brand="Samsung" data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" s>
                            <div class="item-label">
                                <span class="lb-tragop">Tra&#x309; go&#x301;p 0%</span>
                            </div>
                            <div class="item-img 12321312312">
                                <img class="lazyload" data-src="https://cdn.tgdd.vn/Products/Images/42/271698/Galaxy-S22-Ultra-Black-600x600.jpg" alt="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 512GB">
                            </div>
                            <h3 title="&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 512GB">
                                Samsung Galaxy S22 Ultra 5G 512GB
                            </h3>
                            <strong class="price">36.990.000&#x20AB;</strong>
                            <p class="item-gift">Giảm thêm <b>2.000.000₫</b></p>

                        </a>
                        <div class="item-bottom">
                            <a href="#" class="shiping"></a>
                        </div>


                        <a href="javascript:void(0)" class="item-ss">
                            <i></i>
                            So sánh
                        </a>


                    </div>
                </div>
            </div>
        </div>
        <div class="border7"></div>


        <div class="watched">

        </div>

    </div>


    <form class="gallery-rating-popup popup-image-rating-container" data-type="ImageGallery" data-link="">
        <div class="gallery-rating-popup__content">
            <div class="gallery-rating-popup__content__title">Phản hồi không hài lòng <span class="gallery-rating-popup__content__title__close"><i class="iconrating-close"></i></span></div>
            <div class="gallery-rating-popup__content__body">
                <textarea name="inputContent" rows="3" placeholder="Mời bạn góp ý để chúng tôi phục vụ tốt hơn" required></textarea>
                <span class="gallery-rating-popup__content__body__note">Hãy để lại thông tin để được hỗ trợ khi cần thiết (Không bắt buộc):</span>
                <div class="gallery-rating-popup__content__body__genders">
                    <label class="gallery-rating-popup__content__body__genders__option" data-value="male"><i></i>Anh</label>
                    <label class="gallery-rating-popup__content__body__genders__option" data-value="female"><i></i>Chị</label>
                    <input type="hidden" name="inputGender" />
                </div>
                <input type="text" name="inputFullName" placeholder="Họ tên" />
                <input type="tel" name="inputPhoneNumber" placeholder="Số điện thoại" data-invalid-message="" />
                <input type="text" name="inputEmail" placeholder="Email" />
                <button class="gallery-rating-popup__content__body__btn-submit" type="submit">Gửi góp ý<span>Cam kết bảo mật thông tin cá nhân</span></button>
                <label class="gallery-rating-popup__content__body__rating-success">Cám ơn bạn đã đánh giá.</label>
            </div>
        </div>
    </form>


    <form class="gallery-rating-popup popup-video-rating-container" data-type="VideoGallery" data-link="">
        <div class="gallery-rating-popup__content">
            <div class="gallery-rating-popup__content__title">Phản hồi không hài lòng <span class="gallery-rating-popup__content__title__close"><i class="iconrating-close"></i></span></div>
            <div class="gallery-rating-popup__content__body">
                <textarea name="inputContent" rows="3" placeholder="Mời bạn góp ý để chúng tôi phục vụ tốt hơn" required></textarea>
                <span class="gallery-rating-popup__content__body__note">Hãy để lại thông tin để được hỗ trợ khi cần thiết (Không bắt buộc):</span>
                <div class="gallery-rating-popup__content__body__genders">
                    <label class="gallery-rating-popup__content__body__genders__option" data-value="male"><i></i>Anh</label>
                    <label class="gallery-rating-popup__content__body__genders__option" data-value="female"><i></i>Chị</label>
                    <input type="hidden" name="inputGender" />
                </div>
                <input type="text" name="inputFullName" placeholder="Họ tên" />
                <input type="tel" name="inputPhoneNumber" placeholder="Số điện thoại" data-invalid-message="" />
                <input type="text" name="inputEmail" placeholder="Email" />
                <button class="gallery-rating-popup__content__body__btn-submit" type="submit">Gửi góp ý<span>Cam kết bảo mật thông tin cá nhân</span></button>
                <label class="gallery-rating-popup__content__body__rating-success">Cám ơn bạn đã đánh giá.</label>
            </div>
        </div>
    </form>



    <form class="article-rating__form" style="display: none;">
        <input type="hidden" name="inputPhoneNumber" value="" />
        <input type="hidden" name="inputGender" value="3" />
        <input type="hidden" name="inputFullName" value="Bạn" />
        <input type="hidden" name="inputProductId" value="235838" />
        <input type="hidden" name="inputAge" />
        <input type="hidden" name="inputContent" />
        <input type="hidden" name="inputLink" value="http://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra" />
    </form>

    <div class="gallery-loading">
            <span class="gallery-loading__cswrap">
        <span class="gallery-loading__cswrap__csdot"></span>
            <span class="gallery-loading__cswrap__csdot"></span>
            <span class="gallery-loading__cswrap__csdot"></span>
            </span>
    </div>

    <div class="popup-addsp">
        <div class="bg-popup"></div>
        <div class="close-popup" onclick="ClosePopup(this)">
            <aside>
                <i></i>
                <span>Đóng</span>
            </aside>
        </div>
        <div class="compare-popup">
            <h4>&#x110;i&#x1EC7;n tho&#x1EA1;i đã xem gần nhất</h4>
            <ul class="pro-compare pro-compare_viewed">
            </ul>
            <h4>Hoặc nhập tên để tìm</h4>
            <form id="searchproductcompare" onsubmit="return false">
                <div class="find-sp">
                    <input type="text" placeholder="Nhập tên &#x111;i&#x1EC7;n tho&#x1EA1;i để tìm" onkeyup="SearchProductCompare(this)">
                    <i class="icon-findcp"></i>
                </div>
                <ul class="pro-compare pro-compare_search"></ul>
            </form>
        </div>
    </div>

    <div class="errorcompare" style="display:none;"></div>





    <!--#region FAQComment-->
    <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "FAQPage",
                "@id": "https://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra#comment",
                "url": "https://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra",
                "commentCount": 10,
                "mainEntity": [{
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Trả góp 0% là không mất thêm tiền khi trả góp phải không ạ",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Chào anh  Dạ trả góp 0% là mức lãi suất  0% anh nha, không biết mình quan tâm trả góp với mức trả trước bao nhiêu và góp trong mấy tháng ạ?  Mong nhận phản hồi từ anh. "
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Sao mình sửa điện thoại ở TGDD mà chưa thấy nhân viên gọi báo giá sửa chữa vật admin",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Chào anh  Dạ trường hợp này anh vui lòng liên hệ với tổng đài bảo hành 1800.1064 để được hỗ trợ kiểm tra anh nha  Thông tin đến anh. "
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "cho mình hỏi có ứng dụng nào chặn cuộc gọi ngoài danh bạ k ạ",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Dạ chị thử sử dụng ứng dụng này xem sao ạ Thông tin đến chị "
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Thu củ đổi mới có áp dụng đồng thờ với quà tăng galaxy ko",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Chào anh  Dạ khuyến mãi Giảm ngay 3,000,000đ qua Quà tặng Galaxy (lấy mã trên máy mới) được áp dụng đồng thời với chương trình Thu cũ đổi mới  ạThông tin đến anh. "
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Giá trừ quà phiên bản 128 là bao nhiêu vậy admin",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Dạ sản phẩm có khuyến mãi Giảm 2.000.000₫ còn 28.990.000₫. Ngoài ra còn có khuyến mãi Giảm ngay 3,000,000đ qua Quà tặng Galaxy (lấy mã trên máy mới) sẽ còn 25.990.000đ mình có thể đến siêu thị  mua hàng hỗ trợ áp dụng nhéThông tin đến anh. "
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Chào ad . Ad tư vấn trả góp cho e với ạ sđt 0937395514",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Chào anh.Dạ bên em nhận tin và sẽ có nhân viên liên hệ lại trong 60 phút để hỗ trợ ạ.Thông tin đến anh. "
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Chào ad . Mình đang dùng S8+ muốn thu cũ đổi mới lên S22 ultra 128 . Kiểm tra giúp",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Chào anh,Dạ theo chương trình Thu cũ đổi mới thì bên em thu lại máy với tình trạng Màn hình đẹp hoạt động tốt và không bị vỡ, giá thu lại khoảng 6.000.000 ₫ (bao gồm trợ giá) anh nha. Anh có thể vui lòng cung cấp thông tin khu vực cụ thể để bên em kiểm tra giúp mình được không ạ?Mong nhận phản hồi từ anh."
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Mua trả góp thẻ tín dung sacombank 12 tháng thì góp bao nhiêu như thế nào",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Chào anh.Anh vui lòng cho em biết thẻ tín dụng mình đang sử dụng là thẻ CREDIT hay thẻ DEBIT,là thẻ Visa, Mastercard hay JCB và anh muốn góp trong vòng 6, 9 hay 12 tháng để bên em hỗ trợ kiểm tra và tư vấn cho anh Mong nhận phản hồi từ anh "
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "S22 ultra 128gb e mua được 6 ngày xài không vừa ý bán lại lỗ bao nhiêu ạ",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Dạ sản phẩm Samsung Galaxy S22 Ultra S908E (8G 128G) Xanh lá (Mới) 27,990,000 mua ngày 06/05/2022 nếu đủ điều kiện bên em hỗ trợ thu mua lại với giá khoảng 22.392.000 đ, tuy nhiên mình cần hủy hồ sơ trả góp với công ty tài chính trước rồi bên em mới hỗ trợ thu lại nha. Nếu mình có nhu cầu đổi trả lại sản phẩm thì vui lòng đem máy cùng tất cả phụ kiện kèm hàng khuyến mãi (nếu có) đến siêu thị gần nhất để được nhân viên bên em hỗ trợ tốt nhất ạ. Thông tin đến anh."
                    }
                }, {
                    "@type": "Question",
                    "upvoteCount": 0,
                    "name": "Ở Hà Nội,có áp dụng thu cũ đổi mới với trả góp không nhỉ",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "upvoteCount": 0,
                        "text": "Chào anh.Dạ sản phẩm có chương trình Giảm đến 4,000,000đ khi Thu cũ Đổi mới (tùy model máy cũ) và kèm trả góp anh nha.Thông tin đến anh. "
                    }
                }]
            }
        </script>
    <!--#endregion-->
    <!--#region Product-->
    <script type="application/ld+json" id="productld">
            {
                "@context": "https://schema.org",
                "@type": "Product",
                "name": "Điện thoại Samsung Galaxy S22 Ultra 5G 128GB",
                "url": null,
                "image": ["https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg"],
                "description": "Mua online điện thoại Samsung Galaxy S22 Ultra 128GB chính hãng, giá rẻ trả góp 0%, giảm ngay 2 triệu và giảm 3 triệu qua quà tặng Galaxy (13-16/5). Giao nhanh, đem nhiều mẫu chọn, cà thẻ tại nhà",
                "sku": "235838",
                "mpn": "235838",
                "brand": {
                    "@type": "Brand",
                    "name": ["Samsung"]
                },
                "review": [{
                    "@type": "Review",
                    "author": {
                        "@type": "Person",
                        "name": "Trần Tùng"
                    },
                    "datePublished": "5/12/2022 6:09:27 AM: dd/MM/yyyy",
                    "reviewBody": "Mới mua dùng dc 2 ngày, Pin tụt khá nhanh dù để chế độ tiết kiệm pin.\nMáy nhạy, xử lý tác vụ nhanh.",
                    "image": null,
                    "reviewRating": {
                        "@type": "Rating",
                        "bestRating": 5,
                        "ratingValue": 3.0
                    }
                }, {
                    "@type": "Review",
                    "author": {
                        "@type": "Person",
                        "name": "Phạm hoài nam"
                    },
                    "datePublished": "4/24/2022 7:03:55 AM: dd/MM/yyyy",
                    "reviewBody": "Thật sự rất thất vọng và bức súc khi tôi mua dùng 10 ngày đã sãy ra lỗi ko cho tôi đổi mới phải kêu tui gửi về hãng..đưa cho kiểm tra thì bấm bấm chẳng làm được gì..kêu về dùng thì vẫn vậy...h qua tháng luôn rồi làm đc j nửa đáng lên án",
                    "image": null,
                    "reviewRating": {
                        "@type": "Rating",
                        "bestRating": 5,
                        "ratingValue": 1.0
                    }
                }],
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "bestRating": 5,
                    "worstRating": 1,
                    "ratingValue": 3.0,
                    "ratingCount": 24
                },
                "additionalProperty": [{
                    "@type": "PropertyValue",
                    "name": "Công nghệ màn hình",
                    "value": "Dynamic AMOLED 2X"
                }, {
                    "@type": "PropertyValue",
                    "name": "Độ phân giải",
                    "value": "2K+ (1440 x 3088 Pixels)"
                }, {
                    "@type": "PropertyValue",
                    "name": "Màn hình rộng",
                    "value": "6.8\" - Tần số quét 120 Hz"
                }, {
                    "@type": "PropertyValue",
                    "name": "Độ sáng tối đa",
                    "value": "1750 nits"
                }, {
                    "@type": "PropertyValue",
                    "name": "Mặt kính cảm ứng",
                    "value": "Kính cường lực Corning Gorilla Glass Victus+"
                }, {
                    "@type": "PropertyValue",
                    "name": "Độ phân giải",
                    "value": "Chính 108 MP & Phụ 12 MP, 10 MP, 10 MP"
                }, {
                    "@type": "PropertyValue",
                    "name": "Quay phim",
                    "value": "4K 2160p@30fps"
                }, {
                    "@type": "PropertyValue",
                    "name": "Đèn Flash",
                    "value": "Đèn LED kép"
                }, {
                    "@type": "PropertyValue",
                    "name": "Tính năng",
                    "value": "AI Camera"
                }, {
                    "@type": "PropertyValue",
                    "name": "Độ phân giải",
                    "value": "40 MP"
                }, {
                    "@type": "PropertyValue",
                    "name": "Tính năng",
                    "value": "Bộ lọc màu"
                }, {
                    "@type": "PropertyValue",
                    "name": "Hệ điều hành",
                    "value": "Android 12"
                }, {
                    "@type": "PropertyValue",
                    "name": "Chip xử lý (CPU)",
                    "value": "Snapdragon 8 Gen 1 8 nhân"
                }, {
                    "@type": "PropertyValue",
                    "name": "Tốc độ CPU",
                    "value": "1 nhân 3 GHz, 3 nhân 2.5 GHz & 4 nhân 1.79 GHz"
                }, {
                    "@type": "PropertyValue",
                    "name": "Chip đồ họa (GPU)",
                    "value": "Adreno 730"
                }, {
                    "@type": "PropertyValue",
                    "name": "RAM",
                    "value": "8 GB"
                }, {
                    "@type": "PropertyValue",
                    "name": "Bộ nhớ trong",
                    "value": "128 GB"
                }, {
                    "@type": "PropertyValue",
                    "name": "Bộ nhớ còn lại (khả dụng) khoảng",
                    "value": "Khoảng 100 GB"
                }, {
                    "@type": "PropertyValue",
                    "name": "Danh bạ",
                    "value": "Không giới hạn"
                }, {
                    "@type": "PropertyValue",
                    "name": "Mạng di động",
                    "value": "Hỗ trợ 5G"
                }, {
                    "@type": "PropertyValue",
                    "name": "SIM",
                    "value": "2 Nano SIM hoặc 1 Nano SIM + 1 eSIM"
                }, {
                    "@type": "PropertyValue",
                    "name": "Wifi",
                    "value": "Dual-band (2.4 GHz/5 GHz)"
                }, {
                    "@type": "PropertyValue",
                    "name": "GPS",
                    "value": "BEIDOU"
                }, {
                    "@type": "PropertyValue",
                    "name": "Bluetooth",
                    "value": "v5.2"
                }, {
                    "@type": "PropertyValue",
                    "name": "Cổng kết nối/sạc",
                    "value": "Type-C"
                }, {
                    "@type": "PropertyValue",
                    "name": "Jack tai nghe",
                    "value": "Type-C"
                }, {
                    "@type": "PropertyValue",
                    "name": "Kết nối khác",
                    "value": "NFC"
                }, {
                    "@type": "PropertyValue",
                    "name": "Dung lượng pin",
                    "value": "5000 mAh"
                }, {
                    "@type": "PropertyValue",
                    "name": "Loại pin",
                    "value": "Li-Ion"
                }, {
                    "@type": "PropertyValue",
                    "name": "Hỗ trợ sạc tối đa",
                    "value": "45 W"
                }, {
                    "@type": "PropertyValue",
                    "name": "Công nghệ pin",
                    "value": "Sạc không dây"
                }, {
                    "@type": "PropertyValue",
                    "name": "Bảo mật nâng cao",
                    "value": "Mở khoá khuôn mặt"
                }, {
                    "@type": "PropertyValue",
                    "name": "Tính năng đặc biệt",
                    "value": "Chạm 2 lần sáng màn hình"
                }, {
                    "@type": "PropertyValue",
                    "name": "Ghi âm",
                    "value": "Ghi âm cuộc gọi"
                }, {
                    "@type": "PropertyValue",
                    "name": "Xem phim",
                    "value": "3GP"
                }, {
                    "@type": "PropertyValue",
                    "name": "Nghe nhạc",
                    "value": "AAC"
                }, {
                    "@type": "PropertyValue",
                    "name": "Thiết kế",
                    "value": "Nguyên khối"
                }, {
                    "@type": "PropertyValue",
                    "name": "Chất liệu",
                    "value": "Khung kim loại & Mặt lưng kính"
                }, {
                    "@type": "PropertyValue",
                    "name": "Kích thước, khối lượng",
                    "value": "Dài 163.3 mm - Ngang 77.9 mm - Dày 8.9 mm - Nặng 228 g"
                }, {
                    "@type": "PropertyValue",
                    "name": "Thời điểm ra mắt",
                    "value": "2/2022"
                }],
                "offers": {
                    "@type": "Offer",
                    "url": "https://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra",
                    "priceCurrency": "VND",
                    "price": 30990000.0,
                    "priceValidUntil": "03/03/2022",
                    "itemCondition": "https://schema.org/NewCondition",
                    "availability": "https://schema.org/InStock",
                    "seller": {
                        "@id": "https://www.thegioididong.com/#Organization"
                    }
                }
            }
        </script>
    <input type="hidden" id="jsonProductGTM" value="{&quot;@context&quot;:&quot;https://schema.org&quot;,&quot;@type&quot;:&quot;Product&quot;,&quot;name&quot;:&quot;&#x110;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 5G 128GB&quot;,&quot;url&quot;:null,&quot;image&quot;:[&quot;https://cdn.tgdd.vn/Products/Images/42/235838/Galaxy-S22-Ultra-Burgundy-600x600.jpg&quot;],&quot;description&quot;:&quot;Mua online &#x111;i&#x1EC7;n tho&#x1EA1;i Samsung Galaxy S22 Ultra 128GB ch&#xED;nh h&#xE3;ng, gi&#xE1; r&#x1EBB; tr&#x1EA3; g&#xF3;p 0%, gi&#x1EA3;m ngay 2 tri&#x1EC7;u v&#xE0; gi&#x1EA3;m 3 tri&#x1EC7;u qua qu&#xE0; t&#x1EB7;ng Galaxy (13-16/5). Giao nhanh, &#x111;em nhi&#x1EC1;u m&#x1EAB;u ch&#x1ECD;n, c&#xE0; th&#x1EBB; t&#x1EA1;i nh&#xE0;&quot;,&quot;sku&quot;:&quot;235838&quot;,&quot;mpn&quot;:&quot;235838&quot;,&quot;brand&quot;:{&quot;@type&quot;:&quot;Brand&quot;,&quot;name&quot;:[&quot;Samsung&quot;]},&quot;review&quot;:[{&quot;@type&quot;:&quot;Review&quot;,&quot;author&quot;:{&quot;@type&quot;:&quot;Person&quot;,&quot;name&quot;:&quot;Tr&#x1EA7;n T&#xF9;ng&quot;},&quot;datePublished&quot;:&quot;5/12/2022 6:09:27 AM: dd/MM/yyyy&quot;,&quot;reviewBody&quot;:&quot;M&#x1EDB;i mua d&#xF9;ng dc 2 ng&#xE0;y, Pin t&#x1EE5;t kh&#xE1; nhanh d&#xF9; &#x111;&#x1EC3; ch&#x1EBF; &#x111;&#x1ED9; ti&#x1EBF;t ki&#x1EC7;m pin.\nM&#xE1;y nh&#x1EA1;y, x&#x1EED; l&#xFD; t&#xE1;c v&#x1EE5; nhanh.&quot;,&quot;image&quot;:null,&quot;reviewRating&quot;:{&quot;@type&quot;:&quot;Rating&quot;,&quot;bestRating&quot;:5,&quot;ratingValue&quot;:3.0}},{&quot;@type&quot;:&quot;Review&quot;,&quot;author&quot;:{&quot;@type&quot;:&quot;Person&quot;,&quot;name&quot;:&quot;Ph&#x1EA1;m ho&#xE0;i nam&quot;},&quot;datePublished&quot;:&quot;4/24/2022 7:03:55 AM: dd/MM/yyyy&quot;,&quot;reviewBody&quot;:&quot;Th&#x1EAD;t s&#x1EF1; r&#x1EA5;t th&#x1EA5;t v&#x1ECD;ng v&#xE0; b&#x1EE9;c s&#xFA;c khi t&#xF4;i mua d&#xF9;ng 10 ng&#xE0;y &#x111;&#xE3; s&#xE3;y ra l&#x1ED7;i ko cho t&#xF4;i &#x111;&#x1ED5;i m&#x1EDB;i ph&#x1EA3;i k&#xEA;u tui g&#x1EED;i v&#x1EC1; h&#xE3;ng..&#x111;&#x1B0;a cho ki&#x1EC3;m tra th&#xEC; b&#x1EA5;m b&#x1EA5;m ch&#x1EB3;ng l&#xE0;m &#x111;&#x1B0;&#x1EE3;c g&#xEC;..k&#xEA;u v&#x1EC1; d&#xF9;ng th&#xEC; v&#x1EAB;n v&#x1EAD;y...h qua th&#xE1;ng lu&#xF4;n r&#x1ED3;i l&#xE0;m &#x111;c j n&#x1EED;a &#x111;&#xE1;ng l&#xEA;n &#xE1;n&quot;,&quot;image&quot;:null,&quot;reviewRating&quot;:{&quot;@type&quot;:&quot;Rating&quot;,&quot;bestRating&quot;:5,&quot;ratingValue&quot;:1.0}}],&quot;aggregateRating&quot;:{&quot;@type&quot;:&quot;AggregateRating&quot;,&quot;bestRating&quot;:5,&quot;worstRating&quot;:1,&quot;ratingValue&quot;:3.0,&quot;ratingCount&quot;:24},&quot;additionalProperty&quot;:[{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;C&#xF4;ng ngh&#x1EC7; m&#xE0;n h&#xEC;nh&quot;,&quot;value&quot;:&quot;Dynamic AMOLED 2X&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;&#x110;&#x1ED9; ph&#xE2;n gi&#x1EA3;i&quot;,&quot;value&quot;:&quot;2K&#x2B; (1440 x 3088 Pixels)&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;M&#xE0;n h&#xEC;nh r&#x1ED9;ng&quot;,&quot;value&quot;:&quot;6.8\&quot; - T&#x1EA7;n s&#x1ED1; qu&#xE9;t 120 Hz&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;&#x110;&#x1ED9; s&#xE1;ng t&#x1ED1;i &#x111;a&quot;,&quot;value&quot;:&quot;1750 nits&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;M&#x1EB7;t k&#xED;nh c&#x1EA3;m &#x1EE9;ng&quot;,&quot;value&quot;:&quot;K&#xED;nh c&#x1B0;&#x1EDD;ng l&#x1EF1;c Corning Gorilla Glass Victus&#x2B;&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;&#x110;&#x1ED9; ph&#xE2;n gi&#x1EA3;i&quot;,&quot;value&quot;:&quot;Ch&#xED;nh 108 MP &amp; Ph&#x1EE5; 12 MP, 10 MP, 10 MP&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Quay phim&quot;,&quot;value&quot;:&quot;4K 2160p@30fps&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;&#x110;&#xE8;n Flash&quot;,&quot;value&quot;:&quot;&#x110;&#xE8;n LED k&#xE9;p&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;T&#xED;nh n&#x103;ng&quot;,&quot;value&quot;:&quot;AI Camera&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;&#x110;&#x1ED9; ph&#xE2;n gi&#x1EA3;i&quot;,&quot;value&quot;:&quot;40 MP&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;T&#xED;nh n&#x103;ng&quot;,&quot;value&quot;:&quot;B&#x1ED9; l&#x1ECD;c m&#xE0;u&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;H&#x1EC7; &#x111;i&#x1EC1;u h&#xE0;nh&quot;,&quot;value&quot;:&quot;Android 12&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Chip x&#x1EED; l&#xFD; (CPU)&quot;,&quot;value&quot;:&quot;Snapdragon 8 Gen 1 8 nh&#xE2;n&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;T&#x1ED1;c &#x111;&#x1ED9; CPU&quot;,&quot;value&quot;:&quot;1 nh&#xE2;n 3 GHz, 3 nh&#xE2;n 2.5 GHz &amp; 4 nh&#xE2;n 1.79 GHz&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Chip &#x111;&#x1ED3; h&#x1ECD;a (GPU)&quot;,&quot;value&quot;:&quot;Adreno 730&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;RAM&quot;,&quot;value&quot;:&quot;8 GB&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;B&#x1ED9; nh&#x1EDB; trong&quot;,&quot;value&quot;:&quot;128 GB&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;B&#x1ED9; nh&#x1EDB; c&#xF2;n l&#x1EA1;i (kh&#x1EA3; d&#x1EE5;ng) kho&#x1EA3;ng&quot;,&quot;value&quot;:&quot;Kho&#x1EA3;ng 100 GB&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Danh b&#x1EA1;&quot;,&quot;value&quot;:&quot;Kh&#xF4;ng gi&#x1EDB;i h&#x1EA1;n&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;M&#x1EA1;ng di &#x111;&#x1ED9;ng&quot;,&quot;value&quot;:&quot;H&#x1ED7; tr&#x1EE3; 5G&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;SIM&quot;,&quot;value&quot;:&quot;2 Nano SIM ho&#x1EB7;c 1 Nano SIM &#x2B; 1 eSIM&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Wifi&quot;,&quot;value&quot;:&quot;Dual-band (2.4 GHz/5 GHz)&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;GPS&quot;,&quot;value&quot;:&quot;BEIDOU&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Bluetooth&quot;,&quot;value&quot;:&quot;v5.2&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;C&#xF4;&#x309;ng k&#xEA;&#x301;t n&#xF4;&#x301;i/sa&#x323;c&quot;,&quot;value&quot;:&quot;Type-C&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Jack tai nghe&quot;,&quot;value&quot;:&quot;Type-C&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;K&#x1EBF;t n&#x1ED1;i kh&#xE1;c&quot;,&quot;value&quot;:&quot;NFC&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Dung l&#x1B0;&#x1EE3;ng pin&quot;,&quot;value&quot;:&quot;5000 mAh&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Lo&#x1EA1;i pin&quot;,&quot;value&quot;:&quot;Li-Ion&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;H&#x1ED7; tr&#x1EE3; s&#x1EA1;c t&#x1ED1;i &#x111;a&quot;,&quot;value&quot;:&quot;45 W&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;C&#xF4;ng ngh&#x1EC7; pin&quot;,&quot;value&quot;:&quot;S&#x1EA1;c kh&#xF4;ng d&#xE2;y&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;B&#x1EA3;o m&#x1EAD;t n&#xE2;ng cao&quot;,&quot;value&quot;:&quot;M&#x1EDF; kho&#xE1; khu&#xF4;n m&#x1EB7;t&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;T&#xED;nh n&#x103;ng &#x111;&#x1EB7;c bi&#x1EC7;t&quot;,&quot;value&quot;:&quot;Ch&#x1EA1;m 2 l&#x1EA7;n s&#xE1;ng m&#xE0;n h&#xEC;nh&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Ghi &#xE2;m&quot;,&quot;value&quot;:&quot;Ghi &#xE2;m cu&#x1ED9;c g&#x1ECD;i&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Xem phim&quot;,&quot;value&quot;:&quot;3GP&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Nghe nh&#x1EA1;c&quot;,&quot;value&quot;:&quot;AAC&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Thi&#x1EBF;t k&#x1EBF;&quot;,&quot;value&quot;:&quot;Nguy&#xEA;n kh&#x1ED1;i&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Ch&#x1EA5;t li&#x1EC7;u&quot;,&quot;value&quot;:&quot;Khung kim lo&#x1EA1;i &amp; M&#x1EB7;t l&#x1B0;ng k&#xED;nh&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;K&#xED;ch th&#x1B0;&#x1EDB;c, kh&#x1ED1;i l&#x1B0;&#x1EE3;ng&quot;,&quot;value&quot;:&quot;D&#xE0;i 163.3 mm - Ngang 77.9 mm - D&#xE0;y 8.9 mm - N&#x1EB7;ng 228 g&quot;},{&quot;@type&quot;:&quot;PropertyValue&quot;,&quot;name&quot;:&quot;Th&#x1EDD;i &#x111;i&#x1EC3;m ra m&#x1EAF;t&quot;,&quot;value&quot;:&quot;2/2022&quot;}],&quot;offers&quot;:{&quot;@type&quot;:&quot;Offer&quot;,&quot;url&quot;:&quot;https://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra&quot;,&quot;priceCurrency&quot;:&quot;VND&quot;,&quot;price&quot;:30990000.0,&quot;priceValidUntil&quot;:&quot;03/03/2022&quot;,&quot;itemCondition&quot;:&quot;https://schema.org/NewCondition&quot;,&quot;availability&quot;:&quot;https://schema.org/InStock&quot;,&quot;seller&quot;:{&quot;@id&quot;:&quot;https://www.thegioididong.com/#Organization&quot;}}}"
    />
    <!--#endregion-->
    <!--#region BreadcrumbList-->
    <script type="application/ld+json" id="breadcrumb">
            {
                "@type": "BreadcrumbList",
                "@context": "https://schema.org",
                "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://www.thegioididong.com",
                        "name": "Thế Giới Di Động"
                    }
                }, {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://www.thegioididong.com/dtdd",
                        "name": "Điện thoại"
                    }
                }, {
                    "@type": "ListItem",
                    "position": 3,
                    "item": {
                        "@id": "https://www.thegioididong.com/dtdd-samsung",
                        "name": "Điện thoại Samsung"
                    }
                }]
            }
        </script>
    <!--#endregion-->
    <!--#region Video-->
    <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "VideoObject",
                "name": "Đánh giá chi tiết Galaxy S22 Ultra: HẾT NƯỚC CHẤM !!! | Thế Giới Di Động",
                "description": "Siêu phẩm rộn ràng nhất làng công nghệ đầu năm 2022 xin được gọi tên Galaxy S22 Ultra. Chiếc máy này có những gì thu hút, biết ngay trong video này nhé.\nLink sản phẩm: https://www.thegioididong.com/samsung-galaxy-s22-ultra\n00:00 - Giới thiệu\n01:07 - Thiết kế\n02:56 - Camera\n04:50 - Màn hình\n06:25 - Bút Spen\n06:37 - Hiệu năng\n07:46 - Pin\n08:37 - Tổng kết\n\n❤️❤️👉 Anh em ơi, hãy bấm SUBSCRIBE kênh Thế Giới Di Động bằng đường link sau đây để ủng hộ tụi mình nhé: http://bit.ly/TGDĐReviews\n--------------\nCập nhật thông tin sản phẩm, khuyến mãi mới nhất, liên hệ tại:\n🖥 Website: https://www.thegioididong.com/\n📱 Fanpage: https://www.facebook.com/thegioididongcom/\n📞 Tổng đài: 1800 1060\n\n#GalaxyS22Ultra #thegioididong #danhgiachitiet",
                "thumbnailUrl": "https://i.ytimg.com/vi/XQMh9vPKTpg/default.jpg",
                "uploadDate": "25/02/2022",
                "duration": "PT9M14S",
                "caption": null,
                "embedUrl": "https://www.youtube.com/embed/XQMh9vPKTpg",
                "contentUrl": null,
                "keywords": null,
                "publisher": {
                    "@type": "Organization",
                    "@id": "https://www.thegioididong.com#Organization"
                },
                "interactionStatistic": {
                    "@type": "InteractionCounter",
                    "interactionType": {
                        "@type": "http://schema.org/WatchAction"
                    },
                    "userInteractionCount": 3625
                },
                "sourceOrganization": null
            }
        </script>
    <!--#endregion-->
    <!--#region Organization-->
    <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "@id": "https://www.thegioididong.com/#Organization",
                "name": "Thế Giới Di Động",
                "alternatename": null,
                "telephone": null,
                "description": null,
                "disambiguatingdescription": null,
                "url": "https://www.thegioididong.com/dtdd",
                "image": null,
                "legalName": null,
                "foundingDate": null,
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://cdn.thegioididong.com/v2015/ContentMwg/logo/logo.png"
                },
                "contactPoint": [{
                    "@type": "ContactPoint",
                    "telephone": "18001060",
                    "contactType": "sales",
                    "areaServed": "VN",
                    "availableLanguage": ["EN", "VN"]
                }, {
                    "@type": "ContactPoint",
                    "telephone": "18001763",
                    "contactType": "technical support",
                    "areaServed": "VN",
                    "availableLanguage": ["EN", "VN"]
                }, {
                    "@type": "ContactPoint",
                    "telephone": "18001062",
                    "contactType": "customer support",
                    "areaServed": "VN",
                    "availableLanguage": ["EN", "VN"]
                }],
                "sameAs": ["https://www.facebook.com/thegioididongcom/", "https://vn.linkedin.com/company/thegioidong-dienmayxanh", "https://www.youtube.com/user/TGDDVideoReviews", "https://www.instagram.com/watch.thegioididong/", "https://vt.tiktok.com/RH9SSp/", "https://vi.wikipedia.org/wiki/Thegioididong.com"],
                "mainEntityOfPage": null,
                "email": null,
                "additionalType": null,
                "founder": null,
                "address": null,
                "foundingLocation": null,
                "areaServed": null,
                "hasOfferCatalog": null,
                "potentialAction": null
            }
        </script>
    <!--#endregion-->
    <input type="hidden" id="DisPriceScenrioGTM" value="0.0" />
    <input type="hidden" id="PercentScenrioGTM" value="0" />
    <input type="hidden" id="PriceOriginGTM" value="30990000.0" />
    <input type="hidden" id="DisPriceGTM" value="30990000.0" />
    <input type="hidden" id="PercentGTM" value="0" />
    <input type="hidden" id="productReviewVideoGTM" value="Yes" />
    <input type="hidden" id="productAvailabilityGTM" value="Yes" />
    <input type="hidden" id="productCategoryGTM" value="Điện thoại" />
    <input type="hidden" id="productIsOLOLGTM" value="False" />
    <input type="hidden" id="productSiteGTM" value="1" />
    <script>
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'pageType': 'Product',
            'pagePlatform': 'Web',
            'pageCategoryLv1': 'Điện thoại',
            'pageCategoryLv2': 'Điện thoại Samsung',
            'pageCategoryLv3': '',
            'pageStatus': 'Kinh doanh'
        })
    </script>



</section>


<div class="popup-button">
    <a href="javascript:;" onclick="showCompare()" id="ss-now">
        <i class="iconcate-ss"></i>
        <span>So sánh <label id="count-ss"></label></span>
    </a>
</div>







<div class="loadingcover" id="dlding">
    <p class="csslder">
            <span class="csswrap">
            <span class="cssdot"></span>
            <span class="cssdot"></span>
            <span class="cssdot"></span>
            </span>
    </p>
</div>
<div class="overlay"></div>


<section class="page1 prmotebannerbhx">
    <div class="prmotebanner-bhx">
    </div>

</section>
<div class="preloader preall">
    <div class="loaderweb"></div>
</div>
<p id="gb-top-page" class="hide">↑</p>

<div id="dldingtext">Bạn vui lòng chờ trong giây lát...</div>
@include('web.Layouts.footer')
<script src="//cdn.tgdd.vn/mwgcart/mwgcore/js/bundle/globalTGDD_V2.min.v202205040400.js" type="text/javascript"></script>
<script>
    var rooturl = '.thegioididong.com';
</script>

<script>
    window.dataLayer = window.dataLayer || [];
</script>


<script defer="defer" async src="/js/Comment/comment.common.min.js?v=202105110200" type="text/javascript"></script>
<script defer="defer" async="async" src="//cdn.tgdd.vn/mwgcart/mwgcore/js/bundle/detailTGDD.min.v202205130230.js"></script>

<script type="text/javascript">
    document.productId = '235838';
    document.cateID = '42';
    document.cateName = 'điện thoại';
    document.cateUrl = 'dtdd';
    document.isDesktop = 1;
    document.minv = '202205141220';
    document.isCoupleWatch = 0;
</script>



<!-- Google Tag Manager -->
<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-WKQZL8');
</script>
<!-- End Google Tag Manager -->

</body>

</html>