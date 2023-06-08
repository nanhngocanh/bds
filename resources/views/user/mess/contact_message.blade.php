@extends('user/layout/post')
@section('content')
    <div style="width: 70% ">
        <div style="background: rgb(6, 6, 113) ">
            <h2 style=" color: aliceblue ">{{ $temp[0]->content }}</h2>
        </div>
        <div style="background: rgb(181, 189, 190)">
            <a>Someone wants you to contact !! <br>  </a>
            <a>Name : {{ $temp[0]->fullname }} <br></a>
            <a>Email : {{ $temp[0]->email }} <br></a>
            <a>Phone Number: {{ $temp[0]->phone }} <br></a>
            <a>Content : {{ $temp[0]->content }} <br></a>
        </div>
    </div>
    <style>
        h2{
            margin: 10px 10px 10px 10px
        }
        a {
            margin: 10px 10px 10px 10px
        }
    </style>
@endsection
