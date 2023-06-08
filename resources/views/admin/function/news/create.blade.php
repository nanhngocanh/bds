@extends('admin/home')

@section('script')
@endsection

@section('content')
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

    <form method="POST" action="#" id="form-news" enctype="multipart/form-data">
        @csrf

        <div class="my-3">
            <label for="" class="form-label">Tieu de</label>
            <input type="text" name="title" id="" class="form-control" value="{{ old("title") }}">
            @error('title')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Noi dung</label>
            <textarea name="content" id="" cols="30" rows="3" class="form-control">{{ old("content") }}</textarea>
            @error('content')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tac gia/Nguon bai viet</label>
            <input type="text" name="auther" id="" class="form-control" value="{{ old("auther") }}">
            @error('auther')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
        <br>
        <div class="row d-flex flex-wrap justify-content-between mb-3">
            <div class="mb-3">
                <label for="" class="form-label">Choose file</label>
                <input type="file" class="form-control" name="images[]" id="" placeholder="" multiple>
            </div>
            @error('images')
                <div class="alert alert-danger my-3"> {{$message}} </div>
            @enderror
        </div>
    </form>
    <br><br>
    <div class="row my-3">
        <div class="col-9"></div>
        <div class="col-3">
            <div class="mb-3 d-flex justify-content-around">
                <button class="btn btn-outline-primary" type="submit" form="form-news"><i class="fa fa-check"></i>  Luu tin</button>
                <a href="{{ route("admin.news") }}"><button class="btn btn-secondary"><i class="fa fa-times"></i> Huy bo</button></a>
            </div>
        </div>
    </div>
</div>
@endsection

