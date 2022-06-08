<!DOCTYPE html>
<html lang="vi-VN">
@include('web.Layouts.header')
<body >
@include('web.Layouts.banner-media')
@include('web.Layouts.menu-top')
@yield('content')
@include('web.Layouts.footer')
</body>
@yield('script')

</html>
