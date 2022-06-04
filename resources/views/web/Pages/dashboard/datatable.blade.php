@php
    $sortKeyAction = ($sort_value == config('pagination.sort.desc')) ? config('pagination.sort.asc') : config('pagination.sort.desc');
@endphp
<table class="table table-bordered table-responsive">
    
        @if ($list)
        <ul class="listproduct">
            @foreach ($list as $phone)
                <li class=" item ajaxed __cate_42" data-index="2" data-id="153856" data-issetup="0" data-maingroup="13" data-subgroup="1491" data-type="1" data-vehicle="1" data-productcode="0131491002306" data-price="14990000.0" data-ordertypeid="2" data-pos="2">
                    <a href='/phone' data-s="OnlineSaving" data-site="1" data-pro="3" data-cache="True" data-sv="webtgdd-26-87" data-name="&#x110;i&#x1EC7;n tho&#x1EA1;i iPhone 11 64GB" data-id="153856" data-price="12990000.0" data-brand="iPhone (Apple)"
                       data-cate="&#x110;i&#x1EC7;n tho&#x1EA1;i" data-box="BoxCate" class="main-contain">

                        <div class="item-label">
                        </div>
                        <div class="item-img item-img_42">
                            <img class="thumb" src="{{$phone['images'][0]['path'] ?? ''}}" alt="iPhone 11">
                        </div>

                        <p class='result-label temp5'><img width='20' height='20' class='lazyload' alt='GIẢM KỊCH SÀN' data-src='https://cdn.tgdd.vn/2022/05/content/labelseagames-50x50-6.png'><span>GIẢM KỊCH SÀN</span></p>
                        <h3>
                            {{$phone['name']}}
                        </h3>
                        <div class="prods-group" data-iscompare="True" data-mergename="iPhone 11" data-lstArranged="153856,210648,210644">
                            <ul>
                                <li data-url="/dtdd/iphone-11" data-id="153856" data-index="0" class="merge__item item act">Rom:  {{$phone['rom_id']->name}}</li>
                                <li data-url="/dtdd/iphone-11" data-id="153856" data-index="0" class="merge__item item act">Ram:  {{$phone['ram_id']->name}}</li>
                            </ul>
                        </div>
                        <p class="item-txt-online">Online giá rẻ</p>
                        <div class="box-p">
                            <p class="price-old black">{{$phone['price']}}</p>
                            <span class="percent">-{{round(($phone['price'] - $phone['sale_off_price'])*100/$phone['price'],1)}}%</span>
                        </div>
                        <strong class="price">{{$phone['sale_off_price']}}</strong>
                        <div class="item-rating">
                            <p>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star"></i>
                                <i class="icon-star-dark"></i>
                            </p>
                            <p class="item-rating-total">828</p>
                        </div>

                    </a>
                    <div class="item-bottom">
                        <a href="#" class="shiping"></a>
                    </div>
                </li>

            @endforeach
        </ul>
        @else
            <tr>
                <td colspan="9">
                    <p class="text-center mt-4 mb-4">Không tìm thấy dữ liệu</p>
                </td>
            </tr>
        @endif
</table>
