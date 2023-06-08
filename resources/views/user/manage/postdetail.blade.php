@extends('user/layout/post')
@section('content')
@php
    if(auth()->user() != null){
@endphp
        <div class="container" id="form">
            <form action="{{ route('user.message.store') }}" method="post" class="">
                @csrf
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-11 text-center">Report form</div>
                    <div class="col-1"><i class="fa fa-times" aria-hidden="true"  id="close-report-form"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Content</label>
                    <input type="text" name="content" id="" class="form-control" placeholder="Message"
                        aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Tin nhắn muốn gửi cho admin</small>
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="message_type_id" id="" placeholder=""
                        value="2">
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="user_id" id="" placeholder=""
                        value="{{ auth()->user()->user_id }}">
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="house_id" id="" placeholder=""
                        value="{{ $house->id }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
@php
    }
@endphp
        
    <div class="conten">

        <ul>
            <div class="row row-cols-1 g-3">
                @php
                    $images = $house->imagess;
                @endphp
                {{-- @foreach ($house->imagess as $image) --}}
                    <div class="w-30 h-30 ">
                        <img src="/storage/image/{{ $images[0]->image }}" class="img-fluid rounded-top"
                            alt="khong">
                    </div>
                {{-- @endforeach --}}
            </div>
            <li>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col-10">
                        <h2>{{ $house->title }}</h2>
                    </div>
                    <div class="col-2" id="show-more">
                        <i class="fa fa-bars" aria-hidden="true" id="show-more-icon"></i>
                        <div id="show-more-box">
                            <div class="show-more-item" id="show-form-message">
                                <i class="fa fa-flag" aria-hidden="true"></i> Báo cáo
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <table>
                    <tr>
                        <th><h5>{{$house->address}} {{$house->commune}}, {{$house->district}}, {{$house->city}}</h5></th>
                        @php
                            if(auth()->user() != null){
                                @endphp
                                <th style="padding-left: 10%; padding-bottom:10px;"><a class="nav-link active" href="{{ route('bookmark.create',['id'=>$house->id]) }}" >
                            <span data-feather="heart" style="color: red"></span></th>
                    </tr>
                    @php
                }
                        @endphp
                        
                </table>
                {{-- <h5>{{$house->address}} {{$house->commune}}, {{$house->district}}, {{$house->city}}</h5>  --}}
            </a></li>
            <li>
                <table style="width: 100%">
                    <tr style="color: grey">
                        <td style="width: 40%">Mức giá</td>
                        <td style="width: 40%">Diện tích</td>
                        <td style="width: 60%">Ngày đăng</td>
                    </tr>
                    <tr>
                        <th>{{$house->type->type === 'rent' ? "$house->price đồng/tháng" : "$house->price đồng" }}</th>
                        <th>{{$house->size}}m2</th>
                        <th>{{ date_create($house->created_at)->format('d/m/Y H:i') }}</th>
                    </tr>

                </table>
            </li>
            <li>
                <h5>Loại tin đăng</h5>
            </li>
            <li>{{ $house->house_type_id == 1 ? 'Bán nhà' : 'Cho thuê nhà' }}</li>
            <li>
                <h5>Thông tin mô tả</h5>
            </li>
            <li>{{ $house->desciption }}</li>
            <li>
                <table style="width: 100%">
                    <tr style="color: grey">
                        <td style="width: 40%">Nội thất</td>
                        <td style="width: 40%">Số phòng ngủ</td>
                        <td style="width: 60%">Số phòng khách</td>
                    </tr>
                    <tr>
                        <th>{{ $house->furniture == 1 ? 'Đầy đủ' : 'Không có' }}</th>
                        <th>{{ $house->bedroom }}</th>
                        <th>{{ $house->livingroom }}</th>
                    </tr>
                </table>
            </li>
            <li>
                <table style="width: 100%">
                    <tr style="color: grey">
                        <td style="width: 40%">Số phòng ăn</td>
                        <td style="width: 40%">Số phòng tắm</td>
                        <td style="width: 60%">Số phòng toilet</td>
                    </tr>
                    <tr>
                        <th>{{ $house->kitchen }}</th>
                        <th>{{ $house->bathroom }}</th>
                        <th>{{ $house->toilet }}</th>
                    </tr>
                </table>
            </li>
            <li><h5>Thông tin liên hệ</h5> </li>
            <li>
                <table style="width: 100%">
                    <tr>
                        <th style="width: 13%;"><img style="width: 70px; height: 70px; border-radius: 70px;" class="avt" src="/storage/image/{{ $user->image->image }}"  alt="avt"></th>
                        <th style="margin-left: 10%;">{{$user->fullname}}</th>
                    </tr>
                </table>
            </li>
            <li>
                <table style="width: 100%">
                    <tr>
                        <td style="width: 5%;" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                          </svg></td>
                          <td style="width: 20%;">{{$user->email}}</td>
                          <td style="width: 5%; padding-left: 7%;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                          </svg></td>
                        <td style="padding-left: 7%;">{{$user->phone}}</td>
                    </tr>
                </table>
            </li>
        </ul>

    </div>

    <style>
        .conten ul {
            width: 200%;
        }

        .conten {
            padding-left: 150px;
            width: 50%;
        }

        .conten ul li {
            list-style: none;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        h2 {
            color: blue;
            margin: 10px 10px 10px 0px;
        }

        .conten img {
            width: 100%;
            height: 400px;

        }
    </style>
@endsection
