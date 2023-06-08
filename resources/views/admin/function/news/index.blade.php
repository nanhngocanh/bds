@extends('admin/home')

@section('content')
    <div class="container mt-3">
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
        <div class="my-3">
            <h1 class="text-center">Quan ly bai dang</h1>
            <form action="">
                <div class="row mb-3">
                    <div class="col-9">
                        <input type="text" name="key" id="" class="form-control"
                            placeholder="Tim kiem theo ten, ID, ...">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div class="row mb-3">
                <div class="col-9">
                    <p>Tat ca</p>
                </div>
                <div class="col-3">
                    <a class="btn btn-secondary" href="{{ route('admin.news.create') }}"><i class="fa fa-plus"></i> Dang
                        tin</a>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Tac gia</th>
                    <th>Tuy chon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $new)
                    <tr>
                        <td>{{ $new->id }}</td>
                        <td>{{ $new->title }}</td>
                        <td>{{ $new->auther }}</td>
                        <td>
                            <div class="row text-black">
                                <div class="col"><a href="{{ route('admin.news.show', ['id' => $new->id]) }}"
                                        class="btn btn-link"><i class="fa fa-eye text-dark"></i></a></div>
                                <div class="col"><a href="{{ route('admin.news.edit', ['id' => $new->id]) }}"
                                        class="btn btn-link"><i class="fa fa-pencil text-dark"></i></a></div>
                                <div class="col">
                                    <form action="{{ route('admin.news.delete', ['id' => $new->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link"
                                            onclick="return confirm('Ban co chac chan xoa tin')"><i
                                                class="fa fa-trash text-dark"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $news->appends(request()->all())->links() }}
        </div>

    </div>
@endsection
