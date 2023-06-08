@extends('user/layout/manage')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="menutop">
        <h3>Danh sách tin lưu</h3>
        <button style="width: 40% ; margin-left: 20px ; background-color:white">
            <form action="" class="form-inline">
                <div class="form-group">
                    <input class="form-control" name="select" placeholder="Tìm kiếm theo tiêu đề, mô tả">
                </div>
                <button type="submit" class="btn btn-primary">
                    <span data-feather="search"></span>
                </button>
            </form>
        </button>
        <ul class="loc">
            <form action="">
                <li class="house_type" style="width: 10%">
                    <div>
                        <h5>Loại tin</h5>
                        <select class="form-type" name="type" style="width: 100%">
                            <option>{{$type == null ? "Tất cả" : $type}}</option>
                            <option>Tất cả</option>
                            <option>Bán</option>
                            <option>Cho thuê</option>
                        </select>
                    </div>
                </li>
                <button type="submit" class="btn btn-primary">
                    <span data-feather="filter"></span>
                </button>
            </form>
        </ul>

    </div>

    @foreach ($house as $item)
        @if (1)
            <ul class="post">
                
                <li>
                    <img src="https://media.vneconomy.vn/images/upload/2022/12/09/anh-bat-dong-san-cov-2.jpg"
                        style="width:200px;height:150px;">
                    <h4>{{ $item->title }}</h4>
                    <table>
                        <th style="width: 200px">
                            {{ $item->house_type_id == 2 ? "$item->price đồng/tháng" : "$item->price đồng" }}</th>
                        <th style="width: 100px">{{ $item->size }}m2</th>
                        <th>{{ $item->district }},{{ $item->city }}</th>
                    </table>
                    {{ date_create($item->created_at)->format('d/m/Y H:i') }} <br>
                    <table class="action">

                        <td>
                            <form action="{{ route('manage.post.detail', ['id' => $item->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-secondary"><span data-feather="eye"> </span> Xem trực
                                    tiếp </button>
                            </form>
                        </td>
                        <td class="text-right">
                            <form action="{{ route('bookmark.delete', ['id' => $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-secondary" style="background-color: red" type="submit"> <span data-feather="trash">
                                    </span> Bỏ Lưu</button>
                            </form>
                        </td>
                    </table>
                </li>
            </ul>
        @endif
    @endforeach
    <hr>

    <style>
        h3 {
            padding-top: 10px;
            margin-left: 20px;
        }

        .loc {
            position: relative;
            padding-top: 110px;
        }

        h4 {
            margin-top: 20px;
            color: blue;
        }

        .search {
            width: 300px;
            border: none;
        }

        .form-state {
            width: 100%;
        }

        select {
            border-radius: 5px;
            height: 40px;
        }

        .menutop {
            height: auto;
            background-color: white;
            position: relative;
        }

        .house_type {
            position: absolute;
            bottom: 20px;
        }

        .loc button{
            position: absolute;
            left: 15%;
            bottom: 20px;
        }

        .type {
            position: absolute;
            right: 20px;
            bottom: 70px;
        }

        .add {
            position: absolute;
            right: 10px;
            bottom: 10px;
        }

        .post {
            position: relative;
            height: 170px;
            width: 95%;
            border-radius: 10px;
            background-color: white;
            margin: 10px 10px 10px 10px;
        }

        .menutop ul li {
            list-style: none;
            clear: left;
        }

        .post li {
            list-style: none;
            clear: left;
        }

        button {
            border-radius: 10px;
            margin-right: 10px;
        }

        .post li img {
            float: left;
            margin-right: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .action {
            position: absolute;
            right: 10px;
            bottom: 10px;
        }

        .conten {
            font-weight: bold;
        }
    </style>
@endsection
