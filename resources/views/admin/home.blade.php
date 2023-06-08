<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Admin page</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('597d1d6a8840eafc2c67', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('notice');
        channel.bind('notice', function(data) {
            createNotice(data.title, data.message, data.type, data.duration, data.src);
        });
    </script>
    @yield('script')

    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Real estate</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="d-flex align-items-center text-muted icon-notice" id="notice">
            <span data-feather="bell" style="margin: 10px 10px 10px 10px"></span>
            <p id="notice-count"></p>
        </div>
        <div class="notice-box" id="notice-box">
        </div>
        <div class="d-flex align-items-center text-muted icon-avatar" id="avatar">
            @php
                $adminInfo = auth('admin')->user()->admin;
            @endphp
            @if ($adminInfo->image != null)
                <img src="/storage/image/{{ $adminInfo->image->image }}" class="avatar avatar-sm" alt="khong">
            @endif
        </div>
        {{-- <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('admin.logout') }}">Sign out</a>
            </li>
        </ul> --}}

        <div class="avatar-box" id="avatar-box">
            <div class="avatar-item">
                <a class="nav-link" href="{{ route('admin.edit_profile') }}">
                    <span data-feather="file-text"></span>
                    Edit profile
                </a>
            </div>
            <div class="avatar-item">
                <a class="nav-link" href="{{ route('admin.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i>
                    Sign out</a>

            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.message.index') }}">
                                <span data-feather="home"></span>
                                Message
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.house.index') }}">
                                <span data-feather="file"></span>
                                Houses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <span data-feather="users"></span>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.news') }}">
                                <span data-feather="layers"></span>
                                News Manager
                            </a>
                        </li>
                    </ul>
                    <h6
                        class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Saved reports</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">

                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div id="toast">
                </div>
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    @yield('content')

                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script>
        function loadNoticeCount() {
            setInterval(function() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("notice-count").innerText = this.responseText;
                    }
                }
                xhttp.open('GET', '{{ route('admin.notices.count') }}', true);
                xhttp.send();
            }, 10000);
        }
        loadNoticeCount();

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
            xhttp.open("GET", '{{ route('admin.notices.index') }}', true);
            xhttp.send();
        }
        loadNotices();

        function noticeViewed(id) {
            var xhttp = new XMLHttpRequest();
            var url = '{{ route('admin.notices.update', ":id") }}';
            var url = url.replace(':id', id);
            xhttp.open("get", url, true);
            console.log(url);
            xhttp.send();
        }
    </script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>

</html>
