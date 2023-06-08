@extends('admin/home')

@section('content')
    <div class="container my-3">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="text-center">Quản lý người dùng</h1>
        <br>
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
        <hr>
        @foreach ($users as $user)
            <div class="card mb-3">
                <div class="card-header">
                    <h6>{{ $user->fullname }}</h6>
                </div>
                <div class="card-body row">
                    <div class='col-4'>
                        <p class="card-text">Email: {{ $user->email }}</p>
                    </div>
                    <div class='col-4'>
                        <p class="card-text">Phone number: {{ $user->phone }}</p>
                    </div>
                    <div class='col-4 d-flex justify-content-end'>
                        @if ($user->block_state)
                            <form action="{{ route('unblock', ['id' => $user->id]) }}" method="post" class="hidden">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-outline-primary">Unblock</button>
                            </form>
                        @else
                            <form action="{{ route('block', ['id' => $user->id]) }}" method="post" class="hidden">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-outline-danger">Block</button>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        @endforeach

        <div>
            {{ $users->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
