@extends('layout/auth')
@section('title', 'Login admin')

@section('script')
    <script>
        $(document).ready(function(){
            $('#alogin').addClass('active')
        });
    </script>
@endsection

@section('content')
<div class="container mt-3">
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="my-3">
            <label for="username" class="form-label">User name: </label>
            <input type="text" name="username" placeholder="user name" class="form-control" required value="{{ old('username') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password: </label>
            <input type="password" name="password" placeholder="password" class="form-control" required>
        </div>
        <input type="submit" value="Login" class="btn btn-primary">
    </form>
</div>
    
@endsection
