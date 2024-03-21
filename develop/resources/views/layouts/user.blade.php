<!DOCTYPE html>
<html>
<!-- <head>
    @yield('includes.header_meta')
    @include('includes.lib_css')
    @yield('css')
</head> -->

<head>
    @include('includes.head')
    @include('includes.header_meta', ['page_title' => 'YoursHealth | 友益食'])
    <title>YoursHealth | 友益食</title>
    <link rel="icon" href="/img/logo_icon.ico">
</head>


<body @yield('body')>
    @include('includes.navbar')
    <div class="container" style="padding: 2em 0;">

        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link nav_link" id="nav_dashboard" href="/user">會員中心</a></li>
            <li class="nav-item"><a class="nav-link nav_link" id="nav_profile" href="/user/profile">基本資料</a></li>
            <!-- <li class="nav-item"><a class="nav-link nav_link" id="nav_" href="/user/order">訂購資料</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link nav_link" id="nav_" href="/user/points">會員點數</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link nav_link" id="nav_" href="/user/coupon" >優惠卡券</a></li> -->
            <li class="nav-item"><a class="nav-link nav_link" id="nav_order" href="/user/order">訂單查詢</a></li>
            <!-- <li class="nav-item"><a class="nav-link nav_link" id="nav_wishlist" href="/user/wishlist">一鍵速訂</a></li> -->
        </ul>


        @yield('content')
    </div>
    <!-- @include('includes.lib_script') -->
    @yield('end_script')
    <!-- @include('includes.footer') -->
</body>
</html>