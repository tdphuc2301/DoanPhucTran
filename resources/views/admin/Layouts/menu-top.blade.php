<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/admin"><img src="{{ asset('resources/admin/assets/images/logo.png') }}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="/admin"><img src="{{ asset('resources/admin/assets/images/favicon.jpg') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
{{--        <div class="search-field d-none d-md-block">--}}
{{--            <form class="d-flex align-items-center h-100" action="#">--}}
{{--                <div class="input-group">--}}
{{--                    <div class="input-group-prepend bg-transparent">--}}
{{--                        <i class="input-group-text border-0 mdi mdi-magnify"></i>--}}
{{--                    </div>--}}
{{--                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{ asset('resources/admin/assets/images/faces/face1.jpg') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ Auth::user()->full_name ?? '' }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item dropdown-item-custom" href="javascript:void(0)" data-toggle="modal"  data-target="#modalChangePass">
                        <i class="mdi mdi-settings-box mr-2 text-success"></i> Đổi mật khẩu </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item dropdown-item-custom" href="{{ route('admin.logout') }}">
                        <i class="mdi mdi-logout mr-2 text-primary"></i> Đăng xuất </a>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
