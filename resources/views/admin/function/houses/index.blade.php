@extends('admin/home')
@section('script')
    <script>
        $(document).ready(function() {
            $("#select-sort").on('click', function() {
                $('#form-sort').submit();
            });
        })
    </script>
@endsection
@section('content')
    <div class="container bg-secondary">
        <h1 class="text-center text-light">Quản lý bài đăng</h1>
        <br>
        <div class="row bg-light mb-3">
            <div class="col-8">
                <h5>Danh sách bài đăng</h5>
            </div>
            <div class="col-4">
                <form action="{{ route('admin.house.index') }}" method="get" id="form-sort">
                    Sort by :
                    <select name="post_state" id="select-sort">
                        <option value="">Tất cả</option>
                        <option value="true">Đã duyệt</option>
                        <option value="false">Chưa duyệt</option>
                    </select>
                    <script>
                        var urlParams = new URLSearchParams(window.location.search);
                        var post_state = urlParams.get('post_state');
                        if (post_state == "" || post_state == null) {
                            $("#select-sort").val('').attr("selected", true);
                        } else if (post_state == "true") {
                            $("#select-sort").val('true').attr("selected", true);
                        } else {
                            $("#select-sort").val('false').attr("selected", true);
                        }
                    </script>
                </form>
            </div>
        </div>

        @foreach ($houses as $house)
            <div class="card mb-3 w-100">
                <div class="row g-0">
                    <div class="col-md-4 w-25" style="margin: auto;">
                        <img src="/storage/image/qưer1677227181896.png" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{ $house->title }}</h4>
                            <p class="card-text">
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col">{{ $house->title }}</div>
                                <div class="col">
                                    {{ $house->price }}{{ $house->type->type === 'rent' ? 'đồng/tháng' : 'đồng' }}</div>
                                <div class="col">{{ $house->district }}, {{ $house->city }}</div>
                            </div>
                            </p>
                            <div style="width: 10%">
                                <p style="background-color: {{ $house->post_state == 0 ? 'rgb(126, 126, 70)' : 'green' }}">
                                    {{ $house->post_state == false ? 'Chờ duyệt' : 'Đã duyệt' }}
                                </p>
                            </div>
                            <div class="row" style="margin-left: auto;width: 60%">
                                <div class="col-5">
                                    <a href="{{ route('manage.post.detail', ['id' => $house->id]) }}"
                                        class="btn btn-secondary">
                                        <span data-feather="eye"> </span> Xem trực tiếp
                                    </a>
                                </div>
                                <div class="col-5">
                                    <form action="{{ route('admin.house.approve', ['id' => $house->id]) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-{{ $house->post_state == false ? 'success' : 'danger' }}">
                                            @if ($house->post_state == false)
                                                <i class="fa fa-check"></i> Xác nhận duyệt
                                            @else
                                                <i class="fa fa-trash"></i> Hủy duyệt
                                            @endif
                                        </button>
                                    </form>
                                </div>

                            </div>
                            <p class="card-text"><small class="text-muted">Last updated {{ $house->updated_at }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div>
            {{ $houses->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
