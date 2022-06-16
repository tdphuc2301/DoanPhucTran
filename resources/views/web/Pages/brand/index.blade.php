@extends('web.Layouts.app')
@section('content')
<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2 style="font-size:15px; font-weight:bold">Nhập địa chỉ gần nhất mà quí khách muốn nhận hàng</h2>
        </div>
        <div class="modal-body">
            <div class="location-search">
                <i class="icon-search"></i>
                <input class="" name="search_address" id="search_address"
                       placeholder="Tìm nhanh tỉnh thành, quận huyện, phường xã"/>
                <form autocomplete="off">
                    <div id="result"></div>
                </form>

                <div style="text-align: center;">
                    <button class="button" style="background-color: red;">Close</button>
                    <button class="button">Kết quả</button>

                </div>
            </div>
        </div>
    </div>

</div>
<div class="bg-ellipse"></div>
<div class="locationbox__overlay"></div>

<div class="margin-section"></div>
<div class="bsc-block">
    <section>

        <ul class="breadcrumb hide">
            <li><a href="dtdd">&#x110;i&#x1EC7;n tho&#x1EA1;i</a></li>
            <li>
                <p class="sort-total"><b>102</b> ...</p>
            </li>
        </ul>

    </section>
</div>

<div class="top-banner">
    <section>
        <div class="slider-bannertop owl-carousel owl-theme">
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554" href="https://www.thegioididong.com/uu-dai-soc"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=52115&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 src="//cdn.tgdd.vn/2022/05/banner/Desk-800x200-5.png"
                            alt="xả hàng"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554" href="https://www.thegioididong.com/samsung"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=54513&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/sea-aseri-800-200-800x200-1.png" alt="A53"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554" href="https://www.thegioididong.com/dtdd-vivo"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=54432&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/vivo-800-200-800x200.png" alt="Vivo Y55"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554"
                   href="https://www.thegioididong.com/dtdd/realme-9-4g"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=54467&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/800-200-800x200-137.png" alt="Realme 9"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554"
                   href='https://www.thegioididong.com/dtdd/iphone-se-2022'
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=54453&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/13se-800-200-800x200.png" alt="iPhone SE"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554"
                   href="https://www.thegioididong.com/dtdd/oppo-reno6-z-5g"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=53917&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/sea-reno6-800-200-800x200-1.png" alt="Reno7"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554" href="https://www.thegioididong.com/dtdd-xiaomi"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=54050&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/800-200-800x200-28.png" alt="đt"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554"
                   href="https://www.thegioididong.com/dtdd/nokia-g11"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=53971&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/800-200-800x200-16.png" alt="Nokia G11"></a>
            </div>
            <div class="item">
                <a aria-label="slide" data-cate="42" data-place="1554"
                   href="https://www.thegioididong.com/dtdd/samsung-galaxy-s22-ultra"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=53894&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            width=800 height=200 loading="lazy" class="lazyload owl-lazy"
                            data-src="//cdn.tgdd.vn/2022/05/banner/S22-800-200-800x200.png" alt="S22"></a>
            </div>
        </div>
        <div class="promote-banner ">
            <a href="/Fold Flip" class="promote-item">
                <a aria-label="slide" data-cate="42" data-place="1555" href="https://www.thegioididong.com/samsung"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=53892&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            src="//cdn.tgdd.vn/2022/05/banner/sticky-sam-390-97-390x97.png" alt="Samsung"></a>
            </a>
            <a href="/OPPO" class="promote-item">
                <a aria-label="slide" data-cate="42" data-place="1555" href="https://www.thegioididong.com/dtdd-oppo-a"
                   onclick="jQuery.ajax({ url: '/bannertracking?bid=54278&r='+ (new Date).getTime(), async: true, cache: false });"><img
                            src="//cdn.tgdd.vn/2022/05/banner/sticky-aseri-390-97-390x97-1.png" alt="OPPO"></a>
            </a>
        </div>

    </section>
</div>


<div class="box-filter top-box  block-scroll-main cate-42">
    <section>
        <div class="jsfix scrolling_inner scroll-right">
            <div class="box-filter block-scroll-main scrolling">
                <div class="scroll-btn show-right">
                    <div class="btn-right-scroll"></div>
                </div>


                <div class="filter-total ">
                    <div class="filter-item__title jsTitle">
                        <div class="arrow-filter"></div>
                        <i class="icon-filter"></i>Bộ lọc
                        <strong class="number count-total"></strong>
                    </div>
                    <div class="filter-show show-total" id="wrapper">
                        <div class="list-filter-active">
                            <span>Đã chọn: </span>
                            <div class="manu"></div>
                            <div class="price"></div>
                            <div class="props"></div>
                            <div class="props-slider"></div>
                            <a href="javascript:;" class="clr-filter" onclick="removeAllFilterActive()">Xóa tất cả</a>
                        </div>
                        <div class="show-total-main">
                            <a href="javascript:;" class="close-popup-total"><i class="iconcate-closess"></i>Đóng</a>

                            
                            <div class="filter-border"></div>
                            <div class="show-total-item ">
                                <p class="show-total-txt">Giá</p>
                                <div class="filter-list ">
                                    @foreach ($listPrice as $price)
                                        <a class="c-btnbox price_search" prices="{{$price['prices']}}" >{{$price['name']}}</a>
                                    @endforeach
                                </div>

                            </div>
                            <div class="show-total-item  count-item">
                                <p class="show-total-txt">Loại điện thoại</p>
                                <div class="filter-list">
                                    @foreach ($categories as $category)
                                        <a class="c-btnbox category_search" category_id="{{$category['id']}}">{{$category['name']}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="show-total-item  count-item">
                                <p class="show-total-txt">RAM</p>
                                <div class="filter-list ">
                                    @foreach ($rams as $ram)
                                        <a class="c-btnbox ram_search" ram_id="{{$ram['id']}}">{{$ram['name']}}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="show-total-item  count-item">
                                <p class="show-total-txt">Bộ nhớ trong</p>
                                <div class="filter-list">
                                    @foreach ($roms as $rom)
                                        <a class="c-btnbox rom_search" rom_id="{{$rom['id']}}">{{$rom['name']}}</a>
                                    @endforeach
                                </div>
                            </div>
                            
                            
                            <div class="button-filter" style="display: none">
                                <a class="btn-filter-close">Bỏ chọn</a>
                                <a class="btn-filter-readmore result-search-filter" >Xem kết quả</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="filter-item warpper-price-outside">
                    <div class="filter-item__title jsTitle">
                        <div class="arrow-filter"></div>
                        <span>Giá</span></div>
                    <div class="filter-show">
                        <div class="filter-list ">
                            @foreach ($listPrice as $price)
                                <a class="c-btnbox price_search" prices="{{$price['prices']}}" >{{$price['name']}}</a>
                            @endforeach
                        </div>

                        <div class="button-filter" style="display: none">
                            <a class="btn-filter-close">Bỏ chọn</a>
                            <a class="btn-filter-readmore result-search-filter" >Xem kết quả</a>
                        </div>
                    </div>
                </div>
                <div class="filter-item ">
                    <div class="filter-item__title jsTitle">
                        <div class="arrow-filter"></div>
                        <span>Loại điện thoại</span>
                    </div>

                    <div class="filter-show">
                        <div class="filter-list">
                            @foreach ($categories as $category)
                                <a class="c-btnbox category_search" category_id="{{$category['id']}}">{{$category['name']}}</a>
                            @endforeach
                        </div>
                        <div class="button-filter" style="display: none">
                            <a class="btn-filter-close">Bỏ chọn</a>
                            <a class="btn-filter-readmore result-search-filter" >Xem kết quả</a>
                        </div>
                    </div>
                </div>
                <div class="filter-item ">
                    <div class="filter-item__title jsTitle ">
                        <div class="arrow-filter"></div>
                        <span>RAM</span>
                    </div>

                    <div class="filter-show">
                        <div class="filter-list ">
                            @foreach ($rams as $ram)
                                <a class="c-btnbox ram_search" ram_id="{{$ram['id']}}">{{$ram['name']}}</a>
                            @endforeach
                        </div>
                        <div class="button-filter" style="display: none">
                            <a class="btn-filter-close">Bỏ chọn</a>
                            <a class="btn-filter-readmore result-search-filter" >Xem kết quả</a>
                        </div>
                    </div>
                </div>
                <div class="filter-item ">
                    <div class="filter-item__title jsTitle">
                        <div class="arrow-filter"></div>
                        <span>Bộ nhớ  trong</span>
                    </div>

                    <div class="filter-show">
                        <div class="filter-list">
                            @foreach ($roms as $rom)
                                <a class="c-btnbox rom_search" rom_id="{{$rom['id']}}">{{$rom['name']}}</a>
                            @endforeach
                        </div>
                        <div class="button-filter" style="display: none">
                            <a class="btn-filter-close">Bỏ chọn</a>
                            <a class="btn-filter-readmore result-search-filter" >Xem kết quả</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section id="categoryPage" data-id="42" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i" data-template="cate">

    <div class="box-sort ">
        <p class="sort-total"><b class="result-search-filters"></b> điện thoại <strong class="manu-sort"></strong></p>
        <div class="box-checkbox extend  ">
            <a id="myBtn" data-type="fast" class="c-checkitem fastdeli">
                <span class="tick-checkbox"></span>
                <i class="thunder-icon">
                    <img src="//cdn.tgdd.vn/mwgcart/mwgcore/ContentMwg/images/icon-thunder.png"/>
                </i>
                <p>Giao nhanh</p>
            </a>
            <a href="javascript:;" data-href="" data-type="sp2020" class="c-checkitem ">
                <span class="tick-checkbox"></span>
                <p>Giảm giá</p>
            </a>
            <a href="javascript:;" data-href="-tra-gop-0-phan-tram" data-type="installment0" class="c-checkitem ">
                <span class="tick-checkbox"></span>
                <p>Góp 0%</p>
            </a>
            <a href="javascript:;" data-href="" data-type="monopoly" class="c-checkitem">
                <span class="tick-checkbox"></span>
                <p>Độc quyền</p>
            </a>
            <a href="javascript:;" data-href="-moi-ra-mat" data-type="new" data-prop="0" data-newv2="False"
               class="c-checkitem ">
                <span class="tick-checkbox"></span>
                <p>M&#x1EDB;i</p>
            </a>

        </div>
        <div class="sort-select ">
            <p class="click-sort">Xếp theo: <span class="sort-show">N&#x1ED5;i b&#x1EAD;t</span></p>
            <div class="sort-select-main sort ">
                <p><a href="javascript:;" class="check" data-id="9"><i></i>Nổi bật</a></p>
                <p><a href="javascript:;" class="" data-id="5"><i></i>% Giảm</a></p>
                <p><a href="javascript:;" class="" data-id="3"><i></i>Giá cao đến thấp</a></p>
                <p><a href="javascript:;" class="" data-id="2"><i></i>Giá thấp đến cao</a></p>

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="container-productbox">
        <div id="preloader">
            <div id="loader"></div>
        </div>

        <div id="datatable">
            @include('web.Pages.brand.datatable', [
                'list' => $list,
            ])
        </div>
    </div>
</section>
@endsection
@section('script')
<script src="//cdn.tgdd.vn/mwgcart/mwgcore/js/bundle/globalTGDD_V2.min.v202205040400.js"
        type="text/javascript"></script>
<script defer="defer" async="async"
        src="//cdn.tgdd.vn/mwgcart/mwgcore/js/bundle/Category.min.v202205130230.js"></script>

<script>

</script>

<script>

</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


<script>
    let longUser = '';
    let latUser = '';
    $("#search_address").on('keyup', function () {
        var searchValue = $(this).val();

        if (searchValue.length > 0) {
            searchAddress();
        } else {
            $("#result_search li").hide();
        }


    });
    let timeout;

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
                async: true,
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
                    AmagiLoader.hide();
                    console.log(response);
                },
            });
        }, 500)
    }

    function searchBranchClosestUser() {
        let payload = {
            'long': longUser,
            'lat': latUser,
        }
        $.ajax({
            type: 'get',
            data: payload,
            url: '/searchBranchClosestUser',
            context: this,
            dataType: "json",
            async: true,
            success: function (response) {
                $(datatable).html(response.data);
                AmagiLoader.hide();
            },
            beforeSend: function () {
                AmagiLoader.show();
            },
            error: function (response) {
                console.log(response);
            },
        });
    }

    function searchFilterField() {
       
        $.ajax({
            type: 'get',
            data: {filter : filter},
            url: '/searchFilterField',
            context: this,
            dataType: "json",
            async: true,
            success: function (response) {
                $(datatable).html(response.data);
                $('.button-filter').show();
                $('.result-search-filter').html('Xem '+response.countData +' kết quả');
                $('.result-search-filters').html(response.countData);
                AmagiLoader.hide();
            },
            beforeSend: function () {
                AmagiLoader.show();
            },
            error: function (response) {
                AmagiLoader.hide();
                console.log(response);
            },
        });
    }


    $(document).delegate('#search_list li', 'click', function (e) {
        document.getElementById("search_address").value = $(this).text();
        longUser = $(this).attr("long");
        latUser = $(this).attr("lat");
        searchBranchClosestUser();
        console.log("ok");
        document.getElementById("search_list").style.display = 'none';
    });

    let filter = {
        brand : [{{$getBrand['id']}}],
        price : [],
        ram : [],
        rom : [],
        category : [],
        status : 1,
        sort_key : 'created_at',
        sort_value : 0,
    }

    $(document).delegate('.brand_search ', 'click', function (e) {
        let brand_id =$(this).attr("brand_id");
        let checkItem = filter.brand.indexOf(brand_id);
        if( checkItem > -1) {
            $(this).removeClass('check');
            filter.brand.splice(checkItem, 1);
        } else {
            $(this).addClass('check');
            filter.brand.push(brand_id);
        }
        console.log('filter.brand',filter.brand);
        searchFilterField();
    });

    $(document).delegate('.category_search ', 'click', function (e) {
        let category_id =$(this).attr("category_id");
        let checkItem = filter.category.indexOf(category_id);
        if( checkItem > -1) {
            $(this).removeClass('check');
            filter.category.splice(checkItem, 1);
        } else {
            $(this).addClass('check');
            filter.category.push(category_id);
        }
        console.log('filter.category',filter.category);
        searchFilterField();
    });

    $(document).delegate('.ram_search ', 'click', function (e) {
        let ram_id =$(this).attr("ram_id");
        let checkItem = filter.ram.indexOf(ram_id);
        if( checkItem > -1) {
            $(this).removeClass('check');
            filter.ram.splice(checkItem, 1);
        } else {
            $(this).addClass('check');
            filter.ram.push(ram_id);
        }
        console.log('filter.category',filter.ram);
        searchFilterField();
    });

    $(document).delegate('.rom_search ', 'click', function (e) {
        let rom_id =$(this).attr("rom_id");
        let checkItem = filter.rom.indexOf(rom_id);
        if( checkItem > -1) {
            $(this).removeClass('check');
            filter.rom.splice(checkItem, 1);
        } else {
            $(this).addClass('check');
            filter.rom.push(rom_id);
        }
        console.log('filter.category',filter.rom);
        searchFilterField();
    });

    

    $(document).delegate('.price_search ', 'click', function (e) {
        let prices =$(this).attr("prices");
        console.log('prices',prices);
        let checkItem = filter.price.indexOf(prices);
        if( checkItem > -1) {
            $(this).removeClass('check');
            filter.price.splice(checkItem, 1);
        } else {
            $(this).addClass('check');
            filter.price.push(prices);
        }
        console.log('filter.category',filter.price);
        searchFilterField();
    });
    

</script>
@endsection
