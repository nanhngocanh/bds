@extends('layout/header')
@section('content')
    <style>
        .search {
            padding: 13rem;
            background-image: url(https://www.ohanaliving.vn/542ac03681516bcca0dd605bedd41a2b.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
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
            background-color: rgb(34, 107, 253);
        }

        .input-form {
            background-color: white;
            border-radius: 2em;
            display: flex;


        }

        .input-text {
            right: 0;
            width: 100%;
        }

        .news {
            background-color: white;
            padding: 2rem 13rem 2rem 13rem;
        }

        .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .latest>img {
            width: 100%;
        }

        a {
            text-decoration: none;
            color: black
        }

        .realestate {
            background-color: rgb(235, 240, 240);
            padding: 2rem 13rem 2rem 13rem;
        }

        .card {
            margin: 4px;
            border-radius: 0
        }

        .card-img-top {
            border-radius: 0
        }

        .card-body>a {
            float: right;
        }
    </style>
    <div class="search">
        <p>Website số 1 về bất động sản - Mua bán cho thuê nhà đất toàn quốc</p>
        <form action="{{ route('postSearch') }}" method="GET">
            <div class="input-form">
                <div class="select-type">
                    <span data-feather="map-pin" style="    margin: 10px 10px 10px 20px; color: red; width: 3rem;"></span>
                    <select class="form-select" aria-label="Default select example" name="type">
                        <option selected>Loại nhà đất</option>
                        <option value="1">Nhà đất bán</option>
                        <option value="2">Nhà đất cho thuê</option>
                    </select>
                </div>
                <div class="input-text">
                    <input class="form-control" type="text" placeholder="Tìm kiếm theo địa điểm, quận, tên đường, ..."
                        name="key">
                    <button class="search-btn" type="submit"><span data-feather="search"
                            style="margin: 10px 10px 10px 10px;color:white"></span></button>
                </div>
            </div>
        </form>
    </div>
    {{-- tin tuc noi bat --}}
    <div class="news">
        <div class="title">
            <h2>Tin tức nổi bật</h2>
            <a style="color: red" href="{{ route('newsList') }}">Xem thêm
                <span data-feather="arrow-right" style="margin: 10px 10px 10px 10px;"></span>
            </a>
        </div>
        <hr>
        <div class="row">
            <div class="col-4 left-col">
                {{-- bai viet moi nhat --}}
                @foreach ($latest as $item)
                    <a href="{{ route('newsDetail', ['id' => $item->id]) }}" class="latest">
                        @php
                            $images = $item->imagess;
                        @endphp
                        @foreach ($images as $image)
                            <img src="/storage/image/{{ $image->image }}" alt="Ảnh tin tức nổi bật">
                        @endforeach
                        {{-- <img src="https://drscdn.500px.org/photo/59843884/q%3D80_m%3D2000/v2?sig=87856431f6cfadc6a9ee7a5338876a21366d09921b2fc5ce844cbb1652ddf3c7" alt="Ảnh tin tức nổi bật"> --}}
                        <h4>{{ $item->title }}</h4>
                        <p>{{ date_create($item->created_at)->format('d/m/Y H:i') }}</p>
                    </a>
                @endforeach
            </div>
            <div class="col-8 right-col">
                @foreach ($news as $new)
                    <a href="{{ route('newsDetail', ['id' => $new->id]) }}">{{ $new->title }}</a>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
    {{-- bat dong san danh cho ban --}}
    <div class="realestate">
        <h2>Bất động sản dành cho bạn</h2>
        <hr>
        {{-- danh sach bat dong san moi nhat --}}
        <div class="row">
            @foreach ($posts as $post)
                @php
                    $images = $post->imagess;
                @endphp
                <div class="col-3">
                    <div class="card shadow">

                        <img class="card-img-top" {{-- src="https://drscdn.500px.org/photo/59843884/q%3D80_m%3D2000/v2?sig=87856431f6cfadc6a9ee7a5338876a21366d09921b2fc5ce844cbb1652ddf3c7"
                            alt="Card image cap"> --}} src="/storage/image/{{ $images[0]->image }}"
                            alt="Ảnh nhà">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">
                                {{ $post->type->type === 'rent' ? "$post->price đồng/tháng" : "$post->price đồng" }} -
                                {{ $post->size }}m2</p>
                            <p class="card-text">{{ $post->district }},{{ $post->city }}</p>
                            <a style="color: blue" href="{{ route('manage.post.detail', ['id' => $post->id]) }}">Xem thêm
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
