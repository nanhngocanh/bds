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
        <h3>Danh sách tin</h3>
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
                <li class="house_state" style="width: 20%">
                    <div>
                        <h5>Trạng thái tin</h5>
                        <select class="form-state" name="state">
                            <option>{{ $state == null ? 'Tất cả' : $state }}</option>
                            <option>Tất cả</option>
                            <option>Đang hiển thị</option>
                            <option>Chờ hiển thị</option>
                        </select>
                    </div>
                </li>
                <li class="house_type" style="width: 10%">
                    <div>
                        <h5>Loại tin</h5>
                        <select class="form-type" name="type" style="width: 100%">
                            <option>{{ $type == null ? 'Tất cả' : $type }}</option>
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

        <form action="{{ route('post.create') }}" method="get" class="add">
            @csrf
            <button type="submit" class="btn btn-secondary"><span data-feather="plus"> </span> Đăng tin </button>
        </form>
    </div>

    @foreach ($house as $item)
        @if (1)
            <ul class="post">
                @php
                    $images = $item->imagess;
                @endphp
                <li>
                    <img src="/storage/image/{{ $images[0]->image }}" class="img-fluid rounded-top"
                            alt="khong" style="width:200px;height:150px;">
                        
                    <h4>{{ $item->title }}</h4>
                    <table>
                        <th style="width: 200px">
                            {{ $item->type->type === 'rent' ? "$item->price đồng/tháng" : "$item->price đồng" }}</th>
                        <th style="width: 100px">{{ $item->size }}m2</th>
                        <th>{{ $item->district }},{{ $item->city }}</th>
                    </table>
                    {{-- {{ $item->created_at->format('d/m/Y H:i') }} <br> --}}
                    @if ($item->post_state == 0)
                        <table>
                            <td style="width: 10%"></td>
                            <td style="background-color:rgb(126, 126, 70)">Chờ duyệt</td>
                        </table>
                    @else
                        <table>
                            <td style="width: 10%"></td>
                            <td style="background-color:green ">Đã duyệt</td>
                        </table>
                    @endif
                    <table class="action">

                        <td>
                            <form action="{{ route('manage.post.detail', ['id' => $item->id]) }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-secondary"><span data-feather="eye"> </span> Xem trực
                                    tiếp </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('manage.post.edit', ['id' => $item->id]) }}">
                                @csrf
                                <button type="submit" class="btn btn-secondary"> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="currentColor" class="bi bi-pencil"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg> Sửa tin</button>
                            </form>
                        </td>
                        <td class="text-right">
                            <form action="{{ route('manage.post.delete', ['id' => $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-secondary" style="background-color: red" type="submit"
                                    onclick="return confirm('Bạn có chắc muốn xóa tin ?')"> <span data-feather="trash">
                                    </span> Xóa tin</button>
                            </form>
                        </td>
                        {{-- <td><button style="background-color: red"> Xóa tin</button></td> --}}
                    </table>
                </li>
            </ul>
        @endif
    @endforeach
    <hr>

    <div>
        {{ $house->appends(request()->all())->links() }}
    </div>

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

        .house_state {
            position: absolute;
            left: 20px;
            bottom: 20px;
        }

        .house_type {
            position: absolute;
            left: 25%;
            bottom: 20px;
        }

        .loc button {
            position: absolute;
            left: 38%;
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
            width: 90%;
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
