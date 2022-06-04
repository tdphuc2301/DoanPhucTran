<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <!-- CSRF Token -->
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Buylike') }}</title>
    @include('Admin.Layouts.header')
    @yield('head')
</head>
<body class="bg-accpunt-pages" >
<div class="container-scroller">
@include('Admin.Layouts.menu-top')
<!-- partial:partials/_navbar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('Admin.Layouts.menu-left')
    <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('Admin.Layouts.footer')
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>


<div class="system_message">
    <div class="title">Cập nhật thành công</div>
</div>
<div class="system_confirm">
    <div class="box-confirm">
        <div class="title-confirm">Yêu cầu xác nhận</div>

        <div class="btn-confirm">
            <button class="btn btn-secondary">Đóng</button>
            <button class="btn btn-success">Xác nhận</button>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalChangePass">
    <div id="object-change-password"   user_id="{{Auth::user()->id ?? ''}}" 
         class="modal-dialog" >
        <div class="modal-content  bg-white">
            <div class="modal-header">
                <h5 class="modal-title">Thay đổi mật khẩu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group"><p class="m-0 font-0-9">Mật khẩu cũ
                            </p> <input name="password_old" type="password" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"><p class="m-0 font-0-9">Mật khẩu mới
                            </p> <input  name="password" type="password" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"><p class="m-0 font-0-9">Xác nhận mật khẩu mới
                            </p> <input name="confirm_password" type="password" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" onclick="changePassword()" class="btn btn-success">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<script src="{{ asset('resources/admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
{{--<script src="../../resources/admin/assets/js/off-canvas.js"></script>--}}
<script src="{{ asset('resources/admin/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('resources/admin/assets/js/misc.js?time=').time() }}"></script>
<script src="{{ asset('resources/admin/assets/js/lodash.min.js') }}"></script>
<script src="{{ asset('resources/admin/assets/js/todolist.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="{{ asset('resources/admin/assets/vendors/moment/moment.js')}}"></script>
<script src="{{ asset('resources/admin/assets/js/helper.js') }}"></script>
<script  src="{{ asset('js/vendor/ckeditor/ckeditor.js')}}"></script>
<script  src="{{ asset('js/vendor/ckeditor/adapters/jquery.js')}}"></script>
<script  src="{{ asset('vendor/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js')}}"></script>

@yield('script')
<script src="{{ asset('resources/admin/assets/js/custom.js?time=').time() }}"></script>
<script>
    $(document).ready(function() {
        $('textarea.description').ckeditor();
        CKEDITOR.config.filebrowserUploadMethod = "form";
        CKEDITOR.config.filebrowserUploadUrl =
            "{{ route('api.upload.ckeditor') . '?_token=' . csrf_token() }}";
        
    })

    function changePassword() {
            console.log('payload',123);
            let payload = {
                'password_old': $('input[name="password_old"]').val(),
                'password' : $('input[name="password"]').val(),
                'confirm_password' : $('input[name="confirm_password"]').val(),
                'id': $('#object-change-password').attr("user_id")
            }
            
            console.log('payload',payload);
        
        
            $.ajax({
                type: 'POST',
                data: payload,
                url: '{{ route('admin.user.update')}}',
                context: this,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    AmagiLoader.hide();
                    $('.modal').modal('hide');
                    showNotification("Cập nhật thành công ", 'success');
                    
                    
                },
                beforeSend: function () {
                    AmagiLoader.show();
                },
                error: function (response) {
                    AmagiLoader.hide();
                    $('.modal').modal('hide');
                    showNotification("Cập nhật thất bại ", 'danger');
                    
                },
            });

        function showNotification(message, type, time, icon) {
            icon = icon == null ? '' : icon;
            type = type == null ? 'info' : type;
            time = time == null ? 3000 : time;
            $('.system_message').addClass('show').addClass(type);
            $('.system_message').find('.title').html(message);
            setTimeout(function () {
                $('.system_message').removeClass('show').removeClass(type);
                $('.system_message')
            }, time)

        }
    }
</script>
<script>
</script>
</html>
