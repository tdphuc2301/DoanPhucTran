<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <?php $username = Auth::user()->name ?>
    <ul class="nav">
        @if($username === 'manager')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <span class="menu-title">Trang chủ</span>
                    <i class="mdi mdi-account-card-details menu-icon"></i>
                </a>
            </li>
        @endif
        @if($username === 'manager')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.adminUser.index') }}">
                    <span class="menu-title">Danh sách quản trị viên</span>
                    <i class="mdi mdi-account-card-details menu-icon"></i>
                </a>
            </li>
        @endif

        @if($username === 'manager')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.branch.index') }}">
                    <span class="menu-title">Danh sách chi nhánh cửa hàng</span>
                    <i class="mdi mdi-vector-arrange-above menu-icon"></i>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product.index') }}">
                <span class="menu-title">Danh sách sản phẩm</span>
                <i class="mdi mdi-vector-difference-ba menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order.index') }}">
                <span class="menu-title">Danh sách đơn hàng</span>
                <i class="mdi mdi-numeric-2-box-multiple-outline menu-icon"></i>
            </a>
        </li>
            

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.customer.index') }}">
                <span class="menu-title">Danh sách khách hàng</span>
                <i class="mdi mdi-human-child menu-icon"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.category.index') }}">
                <span class="menu-title">Danh sách loại sản phẩm</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.brand.index') }}">
                <span class="menu-title">Danh sách thương hiệu</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.ram.index') }}">
                <span class="menu-title">Danh sách bộ nhớ tạm</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.rom.index') }}">
                <span class="menu-title">Danh sách bộ nhớ trong</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.color.index') }}">
                <span class="menu-title">Danh sách màu</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.promotion.index') }}">
                <span class="menu-title">Danh sách khuyến mãi</span>
                <i class="mdi mdi-vector-difference-ba menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}">
                <span class="menu-title">Danh sách comment</span>
                <i class="mdi mdi-comment-text-outline menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
