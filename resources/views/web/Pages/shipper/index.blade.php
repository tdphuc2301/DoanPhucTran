<!DOCTYPE html>
<html lang="en">
<head>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"></script>
    <title>Shop cart - Bootdey.com</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        button:hover {
            opacity: 1;
        }

        /* Float cancel and delete buttons and add an equal width */
        .cancelbtn, .deletebtn {
            float: left;
            width: 50%;
        }

        /* Add a color to the cancel button */
        .cancelbtn {
            background-color: #ccc;
            color: black;
        }

        /* Add a color to the delete button */
        .deletebtn {
            background-color: #f44336;
        }

        /* Add padding and center-align text to the container */
        .container {
            padding: 16px;
            text-align: center;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: #474e5d;
            padding-top: 50px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* Style the horizontal ruler */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* The Modal Close Button (x) */
        .close {
            position: absolute;
            right: 35px;
            top: 15px;
            font-size: 40px;
            font-weight: bold;
            color: #f1f1f1;
        }

        .close:hover,
        .close:focus {
            color: #f44336;
            cursor: pointer;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Change styles for cancel button and delete button on extra small screens */
        @media screen and (max-width: 300px) {
            .cancelbtn, .deletebtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container mt-5 mb-5">
    <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0; text-align: center;">
        List Phone for shipper
    </h2>
    <?php $base = env('APP_URL'); ?>
    <div class="d-flex justify-content-center row">
        <div id="datatable">
            @include('web.Pages.shipper.datatable', [
                'orders' => $orders,
            ])
        </div>
        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close"
                  title="Close Modal">×</span>
            <form class="modal-content" action="/action_page.php">
                <div class="container">
                    <h1> Xác nhận đơn hàng có mã <span ><strong id="code"></strong></span> </h1>
                    <p>Đơn hàng đã giao đến khách hàng chưa ?</p>

                    <div class="clearfix">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                class="cancelbtn">Chưa
                        </button>
                        <button type="button" onclick="updateStatusOrder()"
                                class="deletebtn">Đã Nhận
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style type="text/css">
    body {
        background: #eee
    }

    .ratings i {
        font-size: 16px;
        color: red
    }

    .strike-text {
        color: red;
        text-decoration: line-through
    }

    .product-image {
        width: 100%
    }

    .dot {
        height: 7px;
        width: 7px;
        margin-left: 6px;
        margin-right: 6px;
        margin-top: 3px;
        background-color: blue;
        border-radius: 50%;
        display: inline-block
    }

    .spec-1 {
        color: #938787;
        font-size: 15px
    }

    h5 {
        font-weight: 400
    }

    .para {
        font-size: 16px
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        showButton();
    });
    function showButton() {
        $('.isDelivery').each(function(){
            console.log($(this).attr('delivery'))
            if($(this).attr('delivery') != 3) {
                $(this).css('display', 'none');
            }
        });
        $('.showPopup').each(function(){
            console.log($(this).attr('delivery'))
            if($(this).attr('delivery') == 3) {
                $(this).css('display', 'none');
            }
        });
    }
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    let code_order ='';

    function showModelConfirmOrder() {
        document.getElementById('id01').style.display = 'block';
    }

    $(document).delegate('.showPopup', 'click', function (e) {
           $('#code').html($(this).attr("order_code"));
        code_order = $(this).attr("order_code");
    });

    function cancelConfirmOrder() {
        document.getElementById('id01').style.display = 'none';
    }

    function updateStatusOrder(id) {

        $.ajax({
            type: 'get',
            data: {code_order : code_order},
            url: '/updateOrder',
            context: this,
            dataType: "json",
            async: true,
            success: function (response) {
                $(datatable).html(response.data);
                showButton();
                document.getElementById('id01').style.display = 'none';
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
    
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>