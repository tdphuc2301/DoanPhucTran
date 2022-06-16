<table class="table table-bordered table-responsive">
    
        @if ($orders)
                <div class="container bootdey">
                    <div class="panel panel-default panel-order">
                        <div class="panel-heading">
                            <h2><strong>Lịch sử đơn hàng</strong></h2>
                            <div class="btn-group pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Filter history <i class="fa fa-filter"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Approved orders</a></li>
                                        <li><a href="#">Pending orders</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            @foreach($orders as $order)
                                <div class="row">
                                    <div class="col-md-1"><img src="{{$order['orderDetails'][0]['images']}}"
                                                               class="media-object img-thumbnail"/></div>
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right"><label class="label {{$order['paids'][0]['showClass']}}">Trạng thái thanh toán: {{$order['paids'][0]['message']}}</label></div>
                                                <span>Mã đơn hàng: <strong>{{$order['code']}}</strong> <br/> Tên sản phẩm: <strong>{{$order['orderDetails'][0]['name']}}</strong></span> <br/>
                                                Quantity : <strong> {{$order['orderDetails'][0]['quantity']}}</strong><br/> Tổng tiền: <strong>{{number_format($order['total_price'])}} vnđ</strong> <br/>
                                                <a data-placement="top" class="btn btn-success btn-xs glyphicon glyphicon-ok" href="#"
                                                   title="View"></a>
                                                <a data-placement="top" class="btn btn-danger btn-xs glyphicon glyphicon-trash" href="#"
                                                   title="Danger"></a>
                                                <a data-placement="top" class="btn btn-info btn-xs glyphicon glyphicon-usd" href="#"
                                                   title="Danger"></a>
                                                <div style="margin-top: 10px;" ><label class="label {{$order['showClassDelivery']}}">Trạng thái shipper: {{$order['messageDelivery']}}</label></div>
                                            </div>
                                            <div class="col-md-12">Đơn hàng được đặt lúc : <strong>{{$order['formatted_created_at']}}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
        @else
            <tr>
                <td colspan="9">
                    <p class="text-center mt-4 mb-4">Không tìm thấy dữ liệu</p>
                </td>
            </tr>
        @endif
</table>
