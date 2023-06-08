<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Bất động sản</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/user_style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('95a142e8a2ee0f3aeaff', {
          cluster: 'ap1'
        });

        var channel = pusher.subscribe('user-notice');
        channel.bind('notice', function(data) {
            createNotice(data.title, data.message, data.type, data.duration, data.src);
        });
      </script>
</head>

<style>
    .logo {
        margin: 1em 2em;
        height: 3em;
    }
    .avt-1 {
        height: 3em;
    }
    .dropdown-menu-right {
        right: 0;
        left: auto;
    }
    .right-11 {
        display: flex;
        align-items: center;
    }
    .left-1 {
        display: flex;
    }
    .item {
        margin-right: 1em
    }
    .left-1>a:link{
        text-decoration: none
    }
    .left-1>a:hover{
        text-decoration: underline
    }
    .left-1>a>span{
        color: black;
        font-weight: 500
    }

    a>span {
        color: black;
    }
    .foot-item{
        padding: 1rem;
        display: flex;
        align-items: center;
    }
    footer{
        background-color: rgb(187, 187, 184)
    }
</style>

<body >
    <nav class="navbar navbar-white sticky-top bg-white flex-md-nowrap p-0 shadow-sm">
        <div class="left-1">
            <a href="{{ route('main') }}">
                <img class="logo" src="https://staticfile.batdongsan.com.vn/images/logo/standard/red/logo.svg">
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('saleSearch') }}">
                <span style="margin: 10px 10px 10px 10px">Nhà đất bán</span>
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('rentSearch') }}">
                <span style="margin: 10px 10px 10px 10px">Nhà đất cho thuê</span>
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('newsList') }}">
                <span style="margin: 10px 10px 10px 10px">Tin tức</span>
            </a>
        </div>

        <div class="right-11">
             <a class="item d-flex align-items-center text-muted" href="{{ route('bookmark') }}">
            <span data-feather="heart" style="margin: 10px 10px 10px 10px"></span>
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('message') }}">
                <span data-feather="bell" style="margin: 10px 10px 10px 10px"></span>
            </a>

            <img class="avt-1" src="https://storage.googleapis.com/hust-files/4586005734621184/images/57348056_10157388605544048_7000169318017138688_o_.2m.png" alt="avt-1">
            <div class="item dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('manage.post') }}"><span data-feather="list" style="margin: 10px 10px 10px 10px"></span>Quản lý tin đăng</a>
              <a class="dropdown-item" href="{{ route('manage.profile') }}"><span data-feather="settings" style="margin: 10px 10px 10px 10px"></span>Cài đặt tài khoản</a>
              <a class="dropdown-item" href="{{ route('logout') }}"><span data-feather="log-out" style="margin: 10px 10px 10px 10px"></span>Đăng xuất</a>
            </div>
          </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row" style="height: auto">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">

                        <li class="nav-item" >
                            <a >
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                  </svg>
                                @yield('name')
                                {{-- @yield('email') --}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('manage.post') }}" style="color: black">
                                <span data-feather="menu"></span>
                                Quản lý tin đăng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bookmark') }}" style="color: black">
                                <span data-feather="heart"></span>
                                Tin lưu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('message') }}" style="color: black">
                                <span data-feather="bell"></span>
                                Liên lạc
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('message') }}" style="color: black">
                                <span data-feather="bell"></span>
                                Thông báo
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('manage.profile') }}" style="color: black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-gear" viewBox="0 0 20 20">
                                    <path
                                        d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                    <path
                                        d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                </svg>
                                {{-- <span data-feather="gears"></span> --}}
                                Cài đặt tài khoản
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" style="color: black">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                                    <path fill-rule="evenodd"
                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                                </svg>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div id="toast">
                </div>
                @yield('content')
            </main>
            <footer class="row">
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
            {{-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            @yield('content')
          </div>
        </main> --}}
        </div>
    </div>
    @yield('js')
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
    <script>
        function loadNotices() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const response = JSON.parse(xhttp.responseText);
                    response.forEach(element => {
                        createNoticeItemBox(element.id, element.title, element.message, "success", element.src, element
                            .viewed);
                    });
                }
            }
            xhttp.open("GET", '{{ route('user.notices.index' ) }}', true);
            xhttp.send();
        }
        loadNotices();

        function noticeViewed(id) {
            var xhttp = new XMLHttpRequest();
            var url = '{{ route('user.notices.update', ":id") }}';
            var url = url.replace(':id', id);
            xhttp.open("get", url, true);
            console.log(url);
            xhttp.send();
        }
    </script>
    <script src="{{ asset('/js/user_js.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>

</html>
