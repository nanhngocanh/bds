@extends('user/layout/post')
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
        <form method="POST" action="{{ route('edit_profile') }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            @if ($userInfo->image != null)
                <div class="div-delete text-center">
                    <img src="/storage/image/{{ $userInfo->image->image }}" class="avatar avatar-lg" alt="khong">
                    <div class="i-delete"><a href="{{ route('user.avatar.destroy', ['id' => $userInfo->image->id]) }}"><i
                                class="fa fa-trash fa-10x"></i></a></div>
                </div>
            @else
                <div class="mb-3">
                    <label for="" class="form-label">Choose Avatar</label>
                    <input type="file" class="form-control" name="avatar" id="" placeholder="">
                </div>
            @endif
            <div class="my-3">
                <label for="fullname" class="form-label">Full name: </label>
                <input type="text" name="fullname" placeholder="EX: Hoang Xuan Bach" class="form-control" required
                    value="{{ $userInfo->fullname }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email: </label>
                <input type="email" name="email" placeholder="EX: aaa@gmail.com" class="form-control" required
                    value="{{ $userInfo->email }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone: </label>
                <input type="text" name="phone" placeholder="EX: 12321434" class="form-control" required
                    value="{{ $userInfo->phone }}">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username: </label>
                <input type="text" name="username" placeholder="Username" class="form-control" required
                    value="{{ $userInfo->userAccount->username }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Current password: </label>
                <input type="password" name="current_password" placeholder="Current password" class="form-control" required>
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">New password vs confirm password: </label>
                <input type="password" name="new_password" placeholder="New password" class="form-control">
            </div>

            <div class="mb-3">
                <input type="password" name="confirm_password" placeholder="Confirm assword" class="form-control">
            </div>

            <input type="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
    {{-- <form method="POST" action="{{ route('edit_profile') }}">
        @csrf
        @method('put')
        <div class="my-3">
            <label for="fullname" class="form-label">Full name: </label>
            <input type="text" name="fullname" placeholder="EX: Hoang Xuan Bach" class="form-control" required
                value="{{ $user->fullname }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email: </label>
            <input type="email" name="email" placeholder="EX: aaa@gmail.com" class="form-control" required
                value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone: </label>
            <input type="text" name="phone" placeholder="EX: 12321434" class="form-control" required
                value="{{ $user->phone }}">
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username: </label>
            <input type="text" name="username" placeholder="Username" class="form-control" required
                value="{{ $user->username }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Current password: </label>
            <input type="password" name="current_password" placeholder="Current password" class="form-control" required>
        </div>


        <div class="mb-3">
            <label for="password" class="form-label">New password vs confirm password: </label>
            <input type="password" name="new_password" placeholder="New password" class="form-control" required>
        </div>

        <div class="mb-3">
            <input type="password" name="confirm_password" placeholder="Confirm assword" class="form-control" required>
        </div>

        <input type="submit" value="Save" class="btn btn-primary">
    </form> --}}
    </div>
@endsection
