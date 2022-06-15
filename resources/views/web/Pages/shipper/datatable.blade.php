<table class="table table-bordered table-responsive">
    
        @if ($orders)
        @foreach($orders as $order)
            <div class="col-md-10">
                <div class="row p-2 bg-white border rounded">
                    <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                                    src="{{'/'.$order['orderDetails'][0]['images']}}"></div>
                    <div class="col-md-6 mt-1 text-left" >
                        <div>Tên sản phẩm: <strong><span style="font-size:20px;font-weight:bold">{{$order['orderDetails'][0]['name']}}</span></strong></div>
                        <div class="">
                            <div class="">Số lượng:
                                <strong>{{$order['orderDetails'][0]['quantity']}}</strong>
                            </div>
                            <p class="text-justify text-truncate para mb-0">Tên khách hàng: <strong>{{$order['customers']['name']}}</strong></p>

                            <p>Địa chỉ:  <strong>{{$order['customers']['address']}} </strong></p>
                            <p>Số điện thoại:  <strong>{{$order['customers']['phone']}} </strong></p>
                        </div>

                    </div>
                    <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <h2 style="font-weight: bold">Tổng tiền : <br/></h2>
                        <h2 style="font-weight: bold;text-decoration: underline">{{number_format($order['total_price'])}} vnđ <br/></h2>
                        <div class="d-flex flex-column mt-4">
                            <button class="btn btn-primary btn-sm isDelivery" type="button"  delivery="{{$order['status_delivered']}}" >Đã nhận hàng</button>
                            <button class="btn btn-outline-primary btn-sm mt-2 showPopup" type="button"
                                    product_id="{{$order['orderDetails'][0]['product_id']}}"
                                    order_code="{{$order['code']}}"
                                    delivery="{{$order['status_delivered']}}"
                                    onclick="showModelConfirmOrder()">Confirm order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @else
            <tr>
                <td colspan="9">
                    <p class="text-center mt-4 mb-4">Không tìm thấy dữ liệu</p>
                </td>
            </tr>
        @endif
</table>
