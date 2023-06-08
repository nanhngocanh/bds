<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    @yield('script')
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }

        .logo {
            margin: 1em 2em;
            height: 3em;
        }

        .avt {
            height: 3em;
        }

        .dropdown-menu-right {
            right: 0;
            left: auto;
        }

        .right {
            display: flex;
            align-items: center;
        }

        .right>a:link {
            text-decoration: none
        }

        .right>a:hover {
            text-decoration: underline
        }

        .right>a>span {
            color: black;
            font-weight: 500
        }

        .left {
            display: flex;
        }

        .item {
            margin-right: 1em
        }

        .left>a:link {
            text-decoration: none
        }

        .left>a:hover {
            text-decoration: underline
        }

        .left>a>span {
            color: black;
            font-weight: 500
        }

        .foot-item {
            padding: 1rem;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-white sticky-top bg-white flex-md-nowrap p-0 shadow-sm">
        <div class="left">
            <a href="{{ route('main') }}">
                <img class="logo" src="https://staticfile.batdongsan.com.vn/images/logo/standard/red/logo.svg">
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('admin.login') }}">
                <span style="margin: 10px 10px 10px 10px">Admin Login</span>
            </a>
        </div>

        <div class="right">
            <a class="item d-flex align-items-center text-muted" href="{{ route('main') }}">
                <span style="margin: 10px 10px 10px 10px">User Home</span>
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('login') }}">
                <span style="margin: 10px 10px 10px 10px">User Login</span>
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('register') }}">
                <span style="margin: 10px 10px 10px 10px">User Register</span>
            </a>

        </div>
    </nav>


    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="row" style="background-color: #aaa; margin-top:240px;">
        <div class="col-3 foot-item">
            <a href="{{ route('main') }}">
                <img class="logo" src="https://staticfile.batdongsan.com.vn/images/logo/standard/red/logo.svg">
            </a>
        </div>
        <div class="col-3 foot-item">
            <span data-feather="phone" style="margin: 10px 10px 10px 10px; width:3rem;height:3rem;"></span>
            <div>
                <h6>Hotline</h6>
                <h6>1900 1900</h6>
            </div>
        </div>
        <div class="col-3 foot-item">
            <span data-feather="users" style="margin: 10px 10px 10px 10px; width:3rem;height:3rem"></span>
            <div>
                <h6>Hỗ trợ khách hàng</h6>
                <h6>support.batdongsan.vn</h6>
            </div>
        </div>
        <div class="col-3 foot-item">
            <span data-feather="headphones" style="margin: 10px 10px 10px 10px; width:3rem;height:3rem"></span>
            <div>
                <h6>Chăm sóc khách hàng</h6>
                <h6>cskh.batdongsan.vn</h6>
            </div>
        </div>
    </footer>

</body>

</html>
