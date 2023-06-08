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
</head>

<style>
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
    .left {
        display: flex;
    }
    .item {
        margin-right: 1em
    }
    .left>a:link{
        text-decoration: none
    }
    .left>a:hover{
        text-decoration: underline
    }
    .left>a>span{
        color: black;
        font-weight: 500
    }
    .foot-item{
        padding: 1rem;
        display: flex;
        align-items: center;
    }
</style>

<body style="background-color: rgb(187, 187, 184);">
    <nav class="navbar navbar-white sticky-top bg-white flex-md-nowrap p-0 shadow-sm">
        <div class="left">
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

        <div class="right">
             <a class="item d-flex align-items-center text-muted" href="{{ route('bookmark') }}">
            <span data-feather="heart" style="margin: 10px 10px 10px 10px"></span>
            </a>
            <a class="item d-flex align-items-center text-muted" href="{{ route('message') }}">
                <span data-feather="bell" style="margin: 10px 10px 10px 10px"></span>
            </a>

            <img class="avt" src="https://storage.googleapis.com/hust-files/4586005734621184/images/57348056_10157388605544048_7000169318017138688_o_.2m.png" alt="avt">
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
    <main role="main">
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
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                    data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    </script>
</body>

</html>
