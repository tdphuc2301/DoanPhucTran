<!DOCTYPE html>
<html lang="vi-VN">
@include('web.Layouts.header')
<body >
@include('web.Layouts.banner-media')
@include('web.Layouts.menu-top')

@yield('content')
@include('web.Layouts.footer')
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
@yield('script')

</html>
