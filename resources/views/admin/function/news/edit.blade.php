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
        @php
            $images = $news->imagess;
        @endphp

        <form method="POST" action="{{ route('admin.news.edit', ['id' => $news->id]) }}" id="form-news"
            enctype="multipart/form-data">
            @csrf
            <div class="my-3">
                <label for="" class="form-label">Tieu de</label>
                <input type="text" name="title" id="" class="form-control" value="{{ $news->title }}">
                @error('title')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Noi dung</label>
                <textarea name="content" id="" cols="30" rows="3" class="form-control">{{ $news->content }}</textarea>
                @error('content')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tac gia/Nguon bai viet</label>
                <input type="text" name="auther" id="" class="form-control" value="{{ $news->auther }}">
                @error('auther')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
            </div>
            <br>
            <div class="row d-flex flex-wrap justify-content-between mb-3">
                <div class="mb-3">
                    <label for="" class="form-label">Choose file</label>
                    <input type="file" class="form-control" name="images[]" id="" placeholder="" multiple>
                </div>
                <div class="row row-cols-3 g-4">
                    @foreach ($images as $image)
                        <div class="w-30 h-30 div-delete col">
                            <img src="/storage/image/{{ $image->image }}" class="img-fluid rounded-top" alt="khong">
                            <div class="i-delete"><a href="{{ route('image.destroy', ['id' => $image->id]) }}"><i
                                        class="fa fa-trash fa-10x"></i> remove</a></div>
                        </div>
                    @endforeach
                </div>
                @error('images')
                    <div class="alert alert-danger my-3"> {{ $message }} </div>
                @enderror
            </div>
        </form>
        <br><br>
        <div class="row my-3">
            <div class="col-8"></div>
            <div class="col-4">
                <div class="mb-3 d-flex justify-content-around">
                    <button class="btn btn-outline-primary" type="submit" form="form-news"><i class="fa fa-check"></i> Luu
                        tin</button>
                    <a href="{{ route('admin.news') }}"><button class="btn btn-secondary"><i class="fa fa-times"></i> Huy
                            bo</button></a>
                    <form action="{{ route('admin.news.delete', ['id' => $news->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Ban co chac chan xoa tin')"><i class="fa fa-trash"> Xoa
                                tin</i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
