@extends('user/layout/post')

@section('script')
    <script>
        $(document).ready(function() {

            // xoa image
            $("div.btn").click(function(e) {
                $(this).parent().css("background-image", "none");
                $(this).addClass("d-none");
                $(this).parent().find("input").val(null);
            });

            // them image
            $("input[type='file']").change(function() {
                $(this).parent().css("background-image", "url(" + window.URL.createObjectURL($(this).prop(
                    'files')[0]) + ")");
                $(this).parent().find("div").removeClass("d-none");
            });
        })
    </script>
@endsection

@php
    // dd($images);
@endphp

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger my-3">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('manage.post.edit', ['id' => $house->id]) }}" id="form-post"
        enctype="multipart/form-data">
        @csrf
        <div class="left">
            <ul>
                <li>
                    <h3>Thông tin bài viết</h3>
                </li>
                <li>
                    <h5>Tiêu đề <span class="sao">*</span></h5>
                </li>
                <li><input type="text" name="title" style="width: 90%" value="{{ $house->title }}"></li>
                @error('title')
                    <div class="alert alert-danger my-3" style="width: 90%"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Mô tả <span class="sao">*</span></h5>
                </li>
                <textarea name="desciption" style="width: 90%">{{ $house->desciption }}</textarea>
                @error('desciption')
                    <div class="alert alert-danger my-3" style="width: 90%"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Ảnh <span class="sao">*</span></h5>
                    <div class="row d-flex flex-wrap justify-content-between mb-3">
                        <div class="mb-3">
                            <label for="" class="form-label">Choose file</label>
                            <input type="file" class="form-control" name="images[]" id="" placeholder=""
                                multiple>
                        </div>
                        <div class="row row-cols-3 g-4">
                            @foreach ($house->imagess as $image)
                                <div class="w-30 h-30 div-delete col">
                                    <img src="/storage/image/{{ $image->image }}" class="img-fluid rounded-top"
                                        alt="khong">
                                    <div class="i-delete"><a
                                            href="{{ route('user.house.images.delete', ['id' => $image->id]) }}"><i
                                                class="fa fa-trash fa-10x"></i> remove</a></div>
                                </div>
                            @endforeach
                        </div>
                        @error('images')
                            <div class="alert alert-danger my-3"> {{ $message }} </div>
                        @enderror
                    </div>
                </li>
            </ul>
        </div>

        <div class="right">
            <ul>
                <li>
                    <h3>Thông tin bất động sản</h3>
                </li>
                <select class="form-type" name="house_type">
                    <option>{{ $house->type->type == 'sell' ? 'Bán' : 'Cho thuê' }}</option>
                    <option>Bán</option>
                    <option>Cho thuê</option>
                </select>
                @error('house_type')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Loại bất động sản <span class="sao">*</span></h5>
                </li>
                <select class="form-kind" name="house_kind">
                    <option>{{ $house->kind->kind == 'apartment' ? 'Chung cư' : 'Nhà riêng' }}</option>
                    <option>Chung cư</option>
                    <option>Nhà riêng</option>
                </select>
                @error('house_kind')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Tỉnh, thành phố <span class="sao">*</span></h5>
                </li>
                <li><input type="text" name="city" style="width: 80%" value="{{ $house->city }}"></li>
                @error('city')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Quận, huyện <span class="sao">*</span></h5>
                </li>
                <li><input type="text" name="district" style="width: 80%" value="{{ $house->district }}"></li>
                @error('district')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Phường, xã <span class="sao">*</span></h5>
                </li>
                <li><input type="text" name="commune" style="width: 80%" value="{{ $house->commune }}"></li>
                @error('commune')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Đường phố</h5>
                </li>
                <li><input type="text" name="address" style="width: 80%" value="{{ $house->address }}"></li>
                <li>
                    <h5>Diện tích (m2) <span class="sao">*</span></h5>
                </li>
                <li><input type="number" name="size" style="width: 80%" value="{{ $house->size }}"></li>
                @error('size')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Mức giá (VND) <span class="sao">*</span></h5>
                </li>
                <li><input type="number" name="price" style="width: 80%" value="{{ $house->price }}"></li>
                @error('price')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
                <li>
                    <h5>Số phòng ngủ</h5>
                </li>
                <li><input type="number" name="bedroom" style="width: 80%" value="{{ $house->bedroom }}"></li>
                <li>
                    <table class="count">
                        <tr>
                            <td>
                                <h5>Số phòng khách</h5>
                            </td>
                            <td>
                                <h5>Số phòng ăn</h5>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="number" name="livingroom" value="{{ $house->livingroom }}"></td>
                            <td><input type="number" name="kitchen" value="{{ $house->kitchen }}"></td>
                        </tr>
                        <tr style="height: 20px"></tr>
                        <tr>
                            <td>
                                <h5>Số phòng tắm</h5>
                            </td>
                            <td>
                                <h5>Số toilet</h5>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="number" name="bathroom" value="{{ $house->bathroom }}"></td>
                            <td><input type="number" name="toilet" value="{{ $house->toilet }}"></td>
                        </tr>
                    </table>
                </li>
                <li>
                    <h5>Nội thất</h5>
                </li>
                <select class="form-furniture" name="furniture">
                    <option>{{ $house->furniture == true ? 'Đầy đủ' : 'Không có' }}</option>
                    <option>Đầy đủ</option>
                    <option>Không có</option>
                </select>


            </ul>

        </div>
    </form>
    <div class="action">
        <table>
            <td style="width: 68%"></td>
            <td style="padding-right: 10px">
                {{-- <form action="{{ route('manage.post.delete', ['id' => $house->id]) }}" method="post">
                    @csrf
                    @method('delete') --}}
                <button class="btn btn-outline-primary" type="submit" form="form-post"
                    onclick="return confirm('Bạn có chắc muốn sửa tin không?')"> <span data-feather="check"> </span> Lưu
                    tin</button>
                {{-- </form> --}}
                {{-- <button class="btn btn-outline-primary" type="submit" form="form-post"> <span data-feather="check"></span>
                    Lưu tin</button> --}}
            </td>
            <td style="padding-right: 10px">
                <a href="{{ route('manage.post') }}"><button class="btn btn-secondary"><span data-feather="x"></span>
                        Hủy bỏ</button></a>
            </td>
            <td>
                <form action="{{ route('manage.post.delete', ['id' => $house->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button style="background-color: red" type="submit" class="btn btn-secondary"
                        onclick="return confirm('Ban co chac chan xoa tin')"> <span data-feather="trash"> </span> Xóa
                        tin</button>
                </form>
            </td>

        </table>
    </div>

    <style>
        .left {
            width: 50%;
            float: left;
        }

        .alert-danger {
            width: 80%;
        }

        textarea {
            border-radius: 5px;
            height: 300px;
        }

        .count td {
            width: 50%;
            padding-right: 40px;
        }

        .sao {
            color: red;
        }

        input {
            border-radius: 5px;
            border-color: grey;
            height: 40px;
        }

        /* .action {
                                position: relative;
                            } */

        .form-kind {
            height: 40px;
            width: 80%;
            border-radius: 5px;
        }

        .form-furniture {
            height: 40px;
            width: 80%;
            border-radius: 5px;
        }

        .right {
            width: 50%;
            float: left;
            position: relative;
        }

        .form-type {
            height: 40px;
            border-radius: 5px;
            width: 20%;
            position: absolute;
            top: 25px;
            right: 20%;
        }

        .left ul li {
            list-style: none;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .right ul li {
            list-style: none;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
@endsection

{{-- @section('content')
<div class="container mt-3">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger my-3">
        {{ session('error') }}
    </div>
    @endif

    <p>Them moi tin tuc</p>

    <form method="POST" action="{{route('admin.news.edit', ['id' => $news->id])}}" id="form-news" enctype="multipart/form-data">
        @csrf
        <div class="my-3">
            <label for="" class="form-label">Tieu de</label>
            <input type="text" name="title" id="" class="form-control" value="{{ $news->title }}">
            @error('title')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Noi dung</label>
            <textarea name="content" id="" cols="30" rows="3" class="form-control">{{ $news->content }}</textarea>
            @error('content')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tac gia/Nguon bai viet</label>
            <input type="text" name="auther" id="" class="form-control" value="{{ $news->auther }}">
            @error('auther')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
        <br>
        <div class="row d-flex flex-wrap justify-content-between mb-3">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-2">
                    <div class="d-flex justify-content-center align-items-center form-image position-relative"
                        style="background-image: {{ ($images[$i] == "null") ? 'none' : "url($images[$i])" }};" >
                        <label class="form-label" for="{{$i}}"><i class="fa fa-plus"></i> Them anh</label>
                        <input type="file" class="form-control d-none" id="{{$i}}" name="images[]" accept=".jpg, .jpeg, .png"/>
                        <div class="btn btn-sm btn-danger position-absolute top-0 start-100 translate-middle {{ ($images[$i] == "null") ? "d-none" : "" }}"><i class="fa fa-times"></i></div>
                    </div>
                </div>
            @endfor
            @error('images')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
    </form>
    <br><br>
    <div class="row my-3">
        <div class="col-8"></div>
        <div class="col-4">
            <div class="mb-3 d-flex justify-content-around">
                <button class="btn btn-outline-primary" type="submit" form="form-news"><i class="fa fa-check"></i>  Luu tin</button>
                <a href="{{ route("admin.news") }}"><button class="btn btn-secondary"><i class="fa fa-times"></i> Huy bo</button></a>
                <form action="{{route('admin.news.delete', ['id' => $news->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Ban co chac chan xoa tin')"><i class="fa fa-trash"> Xoa tin</i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection --}}
