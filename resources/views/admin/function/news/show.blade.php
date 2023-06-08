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
        <p>Tin tuc</p>

        <div class="row row-cols-3 g-4">
            @php
                $images = $news->imagess;
            @endphp
            @foreach ($images as $image)
                <div class="w-30 h-30 div-delete col">
                    <img src="/storage/image/{{ $image->image }}" class="img-fluid rounded-top" alt="khong">
                </div>
            @endforeach
        </div>
    </div>
@endsection
