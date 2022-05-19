<header class="header  " data-sub="0">
    <div class="header__top" style="height:60px">
        <div>
            <a href="/" class="header__logo">
                <i class="iconnewglobal-logo"></i>
            </a>

            <a href="javascript:void(0)" class="header__address" onclick="OpenLocation()">
                Xem giá, tồn kho tại:
                <span data-province="3" data-district="2087" data-ward="27098">5555QL, P.Linh Xu&#xE2;n, TP.Th&#x1EE7; &#x110;&#x1EE9;c (G&#x1ED3;m Q2, Q9, Q.T&#x110;), H&#x1ED3; Ch&#xED; Minh</span>
            </a>
            <form action="/tim-kiem" onsubmit="return suggestSearch(event);" class="header__search">
                <input id="skw" type="text" class="input-search" onkeyup="suggestSearch(event);" placeholder="Bạn tìm gì..." name="key" autocomplete="off" maxlength="100">
                <button type="submit">
                    <i class="icon-search"></i>
                </button>
                <div id="search-result"></div>
            </form>
            <a href="/lich-su-mua-hang" class="name-order">
                Lịch sử đơn hàng
            </a>
            <a href="/cart" class="header__cart menu-info">
                <div class="box-cart">
                    <i class="iconnewglobal-cart"></i>
                    <span class="cart-number"></span>
                </div>
                <span>Giỏ hàng</span>
            </a>
            <div class="header__listtop">
                <div class="divitem">
                    <a href="/tin-tuc">24h<br>Công nghệ</a>
                </div>
                <div class="bordercol"></div>
                <div class="divitem">
                    <a href="/hoi-dap">Hỏi Đáp</a>
                </div>
                <div class="bordercol"></div>
                <div class="divitem">
                    <a href="/game-app">Game App</a>
                </div>
            </div>
        </div>
    </div>
</header>