@extends('layout/auth')
@section('title', 'Register admin')

@section('script')
    <script>
        $(document).ready(function() {
            $('#aregister').addClass('active')
        });
    </script>
@endsection

@section('content')
    <div class="container mt-3">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Choose Avatar</label>
                <input type="file" class="form-control" name="avatar" id="" placeholder="">
            </div>
            <div class="my-3">
                <label for="fullname" class="form-label">Full name: </label>
                <input type="text" name="fullname" placeholder="EX: Hoang Xuan Bach" class="form-control" required
                    value="{{ old('fullname') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email: </label>
                <input type="email" name="email" placeholder="EX: aaa@gmail.com" class="form-control" required
                    value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone: </label>
                <input type="text" name="phone" placeholder="EX: 12321434" class="form-control" required
                    value="{{ old('phone') }}">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username: </label>
                <input type="text" name="username" placeholder="Username" class="form-control" required
                    value="{{ old('username') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password vs confirm password: </label>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>

            <div class="mb-3">
                <input type="password" name="cfpassword" placeholder="Confirm assword" class="form-control" required>
            </div>

            <input type="submit" value="Login" class="btn btn-primary">
        </form>
    </div>

@endsection
