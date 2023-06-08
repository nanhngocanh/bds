@extends('layout/header')
@section('content')
    <style>
        .search {
            padding: 3rem 20rem;
            background-color: white
        }

        .search>p {
            color: white;
            font-weight: 500;
            font-size: 2em
        }

        .select-type,
        .input-text,
        .input-form {
            display: flex;
            align-items: center;
        }

        .search-btn {
            margin: 4px;
            border: none;
            border-radius: 2em;
            background-color: rgb(253, 34, 34);
        }

        .input-form {
            background-color: white;
            border-style: solid;
            border-width: thin;
            border-color: rgb(124, 124, 124);
            border-radius: 2em;
            display: flex;

        }

        .input-text {
            right: 0;
            width: 100%;
            padding-left: 10px
        }

        a {
            text-decoration: none;
            color: black
        }

        .search-input {
            border: none;
        }

        .content {
            padding: 0 3rem;
            background-color: white
        }

        .range {
            width: 10rem;
        }

        .btn-range,
        .btn-range:hover {
            width: 100%;
            border: 1px solid #ced4da;
            text-decoration: none;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .foot-btn {
            margin: 1rem;
            display: flex;
            justify-content: space-around;
        }

        .card {
            padding: 1rem;
            border-radius: 0
        }

        label {
            margin-top: 4px
        }

        .dropdown-menu {
            padding: 1rem;
            border-radius: 0
        }

        .post-item {
            margin: 1rem;
            display: flex;
            align-items: center;
        }
    </style>

    {{-- o tim kiem --}}
    <div class="search">
        <form action="{{ route('saleSearch') }}" method="GET">
            <div class="input-form">
                <div class="input-text">
                    <input class="form-control search-input" type="text" placeholder="Nhập từ khóa để tìm kiếm"
                        name="key">
                    <button class="search-btn" type="submit"><span data-feather="search"
                            style="margin: 10px 10px 10px 10px;color:white"></span></button>
                </div>
            </div>
        </form>
    </div>
    {{-- phần nội dung --}}
    <div class="content row">
        {{-- bộ lọc tìm kiếm --}}
        <div class="col-3">
            <div class="card">
                <h4>Bộ lọc tìm kiếm</h4>
                <form action="{{ route('saleSearch') }}" method="GET">
                    <label for="">Loại nhà đất</label>
                    <select class="form-select" name="kind">
                        <option value="Tất cả">Tất cả</option>
                        <option value="Chung cư">Chung cư</option>
                        <option value="Nhà riêng">Nhà riêng</option>
                    </select>

                    <label for="">Khu vực</label>
                    <select class="form-select" name="add">
                        <option value="Tất cả">Tất cả</option>
                        <option value="An Giang">An Giang</option>
                        <option value="Bà Rịa – Vũng Tàu">Bà Rịa – Vũng Tàu</option>
                        <option value="Bạc Liêu">Bạc Liêu</option>
                        <option value="Bắc Giang">Bắc Giang</option>
                        <option value="Bắc Kạn">Bắc Kạn</option>
                        <option value="Bắc Ninh">Bắc Ninh</option>
                        <option value="Bến Tre">Bến Tre</option>
                        <option value="Bình Dương">Bình Dương</option>
                        <option value="Bình Định">Bình Định</option>
                        <option value="Bình Phước">Bình Phước</option>
                        <option value="Bình Thuận">Bình Thuận</option>
                        <option value="Cà Mau">Cà Mau</option>
                        <option value="Cao Bằng">Cao Bằng</option>
                        <option value="Cần Thơ">Cần Thơ</option>
                        <option value="Đà Nẵng">Đà Nẵng</option>
                        <option value="Đắk Lắk">Đắk Lắk</option>
                        <option value="Đắk Nông">Đắk Nông</option>
                        <option value="Điện Biên">Điện Biên</option>
                        <option value="Đồng Nai">Đồng Nai</option>
                        <option value="Đồng Tháp">Đồng Tháp</option>
                        <option value="Gia Lai">Gia Lai</option>
                        <option value="Hà Giang">Hà Giang</option>
                        <option value="Hà Nam">Hà Nam</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <option value="Hà Tĩnh">Hà Tĩnh</option>
                        <option value="Hải Dương">Hải Dương</option>
                        <option value="Hải Phòng">Hải Phòng</option>
                        <option value="Hậu Giang">Hậu Giang</option>
                        <option value="Hòa Bình">Hòa Bình</option>
                        <option value="Thành phố Hồ Chí Minh">Thành phố Hồ Chí Minh</option>
                        <option value="Hưng Yên">Hưng Yên</option>
                        <option value="Khánh Hòa">Khánh Hòa</option>
                        <option value="Kiên Giang">Kiên Giang</option>
                        <option value="Kon Tum">Kon Tum</option>
                        <option value="Lai Châu">Lai Châu</option>
                        <option value="Lạng Sơn">Lạng Sơn</option>
                        <option value="Lào Cai">Lào Cai</option>
                        <option value="Lâm Đồng">Lâm Đồng</option>
                        <option value="Long An">Long An</option>
                        <option value="Nam Định">Nam Định</option>
                        <option value="Nghệ An">Nghệ An</option>
                        <option value="Ninh Bình">Ninh Bình</option>
                        <option value="Ninh Thuận">Ninh Thuận</option>
                        <option value="Phú Thọ">Phú Thọ</option>
                        <option value="Phú Yên">Phú Yên</option>
                        <option value="Quảng Bình">Quảng Bình</option>
                        <option value="Quảng Nam">Quảng Nam</option>
                        <option value="Quảng Ngãi">Quảng Ngãi</option>
                        <option value="Quảng Ninh">Quảng Ninh</option>
                        <option value="Quảng Trị">Quảng Trị</option>
                        <option value="Sóc Trăng">Sóc Trăng</option>
                        <option value="Sơn La">Sơn La</option>
                        <option value="Tây Ninh">Tây Ninh</option>
                        <option value="Thái Bình">Thái Bình</option>
                        <option value="Thái Nguyên">Thái Nguyên</option>
                        <option value="Thanh Hóa">Thanh Hóa</option>
                        <option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
                        <option value="Tiền Giang">Tiền Giang</option>
                        <option value="Trà Vinh">Trà Vinh</option>
                        <option value="Tuyên Quang">Tuyên Quang</option>
                        <option value="Vĩnh Long">Vĩnh Long</option>
                        <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                        <option value="Yên Bái">Yên Bái</option>

                    </select>

                    <label for="">Mức giá (đồng)</label>
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle btn-range" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Nhập khoảng
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            từ <input class="form-control range" type="number" name="price_start">
                            đến <input class="form-control range" type="number" name="price_end">
                        </div>
                    </div>

                    <label for="">Diện tích (m2)</label>
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle btn-range" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Nhập khoảng
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            từ <input class="form-control range" type="number" name="size_start">
                            đến <input class="form-control range" type="number" name="size_end">
                        </div>
                    </div>

                    <label for="">Số phòng ngủ</label>
                    <input class="form-control" type="number" name="bedroom">
                    <div class="foot-btn">
                        <button class="btn btn-primary" type="submit">
                            <span data-feather="filter" style="width: 3rem;"></span>
                            Lọc</button>
                        <button class="btn btn-danger" type="reset">
                            <span data-feather="refresh-cw" style="width: 3rem;"></span>
                            Đặt lại</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- kết quả tìm kiếm --}}
        <div class="col-9">
            <h3>Bán nhà đất trên toàn quốc</h3>
            {{-- danh sach nha dat --}}
            <div class="list">
                @foreach ($houses as $post)
                    @php
                        $images = $post->imagess;
                    @endphp
                    <a href="{{ route('manage.post.detail', ['id' => $post->id]) }}" class="post-item row">
                        <img class="col-3" src="/storage/image/{{ $images[0]->image }}" alt="Ảnh tin tức">
                        <div class="col-9">
                            <h5>{{ $post->title }}</h5>
                            <h6>{{ $post->type->type === 'rent' ? "$post->price đồng/tháng" : "$post->price đồng" }} -
                                {{ $post->size }}m2 - {{ $post->district }},{{ $post->city }}</h6>
                            <p>{{ date_create($post->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    </a>
                @endforeach
                {{ $houses->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
@endsection
