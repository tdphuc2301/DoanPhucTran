<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Order history</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('web.Layouts.header')
    @include('web.Layouts.banner-media')
    @include('web.Layouts.menu-top')
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
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
                                <div class="pull-right"><label class="label {{$order['paids'][0]['showClass']}}">{{$order['paids'][0]['message']}}</label></div>
                                <span>Mã đơn hàng: <strong>{{$order['code']}}</strong> <br/> Tên sản phẩm: <strong>{{$order['orderDetails'][0]['name']}}</strong></span> <br/>
                                Quantity : <strong> {{$order['orderDetails'][0]['quantity']}}</strong><br/> Tổng tiền: <strong>{{number_format($order['total_price'])}} vnđ</strong> <br/>
                                <a data-placement="top" class="btn btn-success btn-xs glyphicon glyphicon-ok" href="#"
                                   title="View"></a>
                                <a data-placement="top" class="btn btn-danger btn-xs glyphicon glyphicon-trash" href="#"
                                   title="Danger"></a>
                                <a data-placement="top" class="btn btn-info btn-xs glyphicon glyphicon-usd" href="#"
                                   title="Danger"></a>
                            </div>
                            <div class="col-md-12">Đơn hàng được đặt lúc : <strong>{{$order['formatted_created_at']}}</strong></div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</div>


<style type="text/css">
    body{
        background:#eee;
    }
    .panel-order .row {
        border-bottom: 1px solid #ccc;
    }
    .panel-order .row:last-child {
        border: 0px;
    }
    .panel-order .row .col-md-1  {
        text-align: center;
        padding-top: 15px;
    }
    .panel-order .row .col-md-1 img {
        width: 50px;
        max-height: 50px;
    }
    .panel-order .row .row {
        border-bottom: 0;
    }
    .panel-order .row .col-md-11 {
        border-left: 1px solid #ccc;
    }
    .panel-order .row .row .col-md-12 {
        padding-top: 7px;
        padding-bottom: 7px;
    }
    .panel-order .row .row .col-md-12:last-child {
        font-size: 11px;
        color: #555;
        background: #efefef;
    }
    .panel-order .btn-group {
        margin: 0px;
        padding: 0px;
    }
    .panel-order .panel-body {
        padding-top: 0px;
        padding-bottom: 0px;
    }
    .panel-order .panel-deading {
        margin-bottom: 0;
    }
</style>

<script type="text/javascript">


</script>
</body>
</html>