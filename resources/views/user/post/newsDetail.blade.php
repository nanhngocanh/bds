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

        .form-control {
            border: none;
        }

        .list {
            padding: 2rem 13rem 2rem 13rem;
            background-color: white
        }

        .news-item {
            display: flex;
            align-items: center;
            margin-bottom: 2em
        }

        .content {
            background-color: white;
            padding: 2rem 13rem
        }

        .content>img {
            width: 100%;
            margin: 1rem 0;
        }
    </style>

    {{-- o tim kiem --}}
    <div class="search">
        <form action="{{ route('newsSearch') }}" method="GET">
            <div class="input-form">
                <div class="input-text">
                    <input class="form-control" type="text" placeholder="Nhập từ khóa để tìm kiếm">
                    <button class="search-btn" type="submit"><span data-feather="search"
                            style="margin: 10px 10px 10px 10px;color:white"></span></button>
                </div>
            </div>
        </form>
    </div>

    {{-- @foreach ($news as $new) --}}
    <div class="content">
        {{-- title --}}
        <h3>{{ $news->title }}</h3>
        {{-- time --}}
        <p>{{ date_create($news->created_at)->format('d/m/Y H:i') }}</p>
        {{-- image --}}
        @php
            $images = $news->imagess;
        @endphp

        @foreach ($images as $image)
        <img class=""
        src="/storage/image/{{ $image->image }}"
        alt="Ảnh tin tức">
        @endforeach
        
        {{-- content --}}
        <p>{{ $news->content }}</p>
        {{-- author --}}
        <i>Theo {{ $news->auther }}</i>
    </div>
    {{-- @endforeach --}}
@endsection
