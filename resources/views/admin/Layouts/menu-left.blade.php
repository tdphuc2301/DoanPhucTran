<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <?php $username = Auth::user()->name ?>
    <ul class="nav">
        @if($username === 'Manager')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.adminUser.index') }}">
                    <span class="menu-title">Quản trị viên</span>
                    <i class="mdi mdi-account-card-details menu-icon"></i>
                </a>
            </li>
        @endif

        @if($username === 'Manager')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.branch.index') }}">
                    <span class="menu-title">Chi nhánh cửa hàng</span>
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
            <a class="nav-link" href="{{ route('admin.payment_method.index') }}">
                <span class="menu-title">Hình thức thanh toán</span>
                <i class="mdi  mdi-crosshairs-gps menu-icon"></i>
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
                <span class="menu-title">Danh mục loại sản phẩm</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.brand.index') }}">
                <span class="menu-title">Danh mục thương hiệu</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.ram.index') }}">
                <span class="menu-title">Danh mục bộ nhớ tạm</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.rom.index') }}">
                <span class="menu-title">Danh mục bộ nhớ trong</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.color.index') }}">
                <span class="menu-title">Danh mục màu</span>
                <i class="mdi mdi-vector-arrange-above menu-icon"></i>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.promotion.index') }}">
                <span class="menu-title">Chương trình khuyến mãi</span>
                <i class="mdi mdi-vector-difference-ba menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}">
                <span class="menu-title">Quản lý comment</span>
                <i class="mdi mdi-comment-text-outline menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
