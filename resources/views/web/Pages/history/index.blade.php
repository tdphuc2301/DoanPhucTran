<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order history</title>
    @include('web.Layouts.header')
    @include('web.Layouts.banner-media')
    @include('web.Layouts.menu-top')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"/>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<div class="container" style=" margin: 30px auto;  ">
    <div style="padding: 20px;border:5px solid #D01523FF;width: 60%; margin-left: 20%; margin-right: 20%; background-color: #ECD7B8FF;">
    <div class="form-inline" style="text-align: center; left: 10%; top: 10%;">
        <h2 style="font-weight: bold">Tìm kiếm đơn hàng bằng số điện thoại</h2>
        <input style="width:70%;height:50px;" class="form-control mr-sm-2" type="search" placeholder="Số điện thoại" aria-label="Search" name="phone">
        <button style="width:20%;height:50px;background-color: #2B84DEFF;font-weight:bold" class="form-control form-control-sm" onclick="search()">Tìm kiếm</button>
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="container-productbox">
        <div id="preloader">
            <div id="loader"></div>
        </div>

        <div id="datatable">
            @include('web.Pages.history.datatable', [
                'orders' => $list,
            ])
        </div>

    </div>
</div>


<style type="text/css">
    body {
        background: #eee;
    }
</style>

<script type="text/javascript">

    function search() {

        $.ajax({
            type: 'get',
            data: {phone :  $("input[name='phone']").val()},
            url: '/searchHistoryOrderByPhone',
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
                AmagiLoader.hide();
                console.log(response);
            },
        });
    }
</script>
</body>
</html>